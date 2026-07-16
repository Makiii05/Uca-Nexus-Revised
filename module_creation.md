# Module Creation Guide

> Step-by-step workflow for building a new module in this project.
> Follow this order — each step depends on the one before it.

---

## 1. Migration

Create the database table(s) first.

```bash
php artisan make:migration create_xxx_table
```

Guidelines:
- Use `$table->id()` for primary key
- Use `$table->string()` for short text, `$table->text()` for long text
- Use `$table->foreignId('...')->constrained()->cascadeOnDelete()` for foreign keys
- Use `$table->timestamps()` for `created_at` / `updated_at`
- Add `unique()` indexes where needed
- Keep the table name **snake_case plural** (Laravel convention)

```php
// Example
Schema::create('departments', function (Blueprint $table) {
    $table->id();
    $table->string('code');
    $table->string('description');
    $table->string('status');
    $table->timestamps();
});
```

Run: `php artisan migrate`

---

## 2. Model

Create the Eloquent model.

```bash
php artisan make:model Models/Xxx
```

Guidelines:
- `#[Fillable([...])]` — list all columns that can be mass-assigned
- `protected function casts(): array` — cast dates, decimals, booleans
- `protected $table = 'xxx'` — **only** if the table name doesn't match Laravel's pluralization
- Add all `BelongsTo`, `HasMany`, `HasOne` relationships
- No business logic — put that in Services instead

Position: `app/Models/Xxx.php`

```php
#[Fillable(['code', 'description', 'status'])]
class Department extends Model
{
    public function programs(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
```

---

## 3. Service

Create the service class that holds all business logic.

```bash
php artisan make:service Services/XxxService
```

Or create manually at `app/Services/XxxService.php`.

Guidelines:
- One service class per module
- Methods return models or collections, never responses
- No HTTP concerns (no redirects, no request objects)
- Keep methods focused — one method = one operation

```php
class DepartmentService
{
    public function getAll(): Collection
    {
        return Department::orderBy('code')->get();
    }

    public function create(array $data): Department
    {
        return Department::create($data);
    }

    public function update(Department $department, array $data): bool
    {
        return $department->update($data);
    }

    public function delete(Department $department): ?bool
    {
        return $department->delete();
    }
}
```

---

## 4. Form Request

Create a form request for validation.

```bash
php artisan make:request Xxx/StoreXxxRequest
php artisan make:request Xxx/UpdateXxxRequest
```

Position: `app/Http/Requests/Xxx/`

Guidelines:
- `authorize()` — return `true` (gate checks go in Policies)
- `rules()` — return validation rules array
- Use `unique:table,column,except,id` for update rules to ignore the current record

```php
class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:255', 'unique:departments,code'],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ];
    }
}
```

---

## 5. Controller

Create the controller. It should be **thin** — only wire Request → Service → Response.

Position: `app/Http/Controllers/Web/{Module}/XxxController.php`

Guidelines:
- Inject the Service via constructor (Laravel auto-resolves it)
- Inject the Form Request in method signatures
- Methods: `index`, `store`, `update`, `destroy`
- Never write business logic or validation in the controller
- Return views for GET, redirect for POST/PUT/DELETE

```php
class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $departments = $this->departmentService->getAll();
        return view('portals.registrar.departments.index', compact('departments'));
    }

    public function store(StoreDepartmentRequest $request): RedirectResponse
    {
        $this->departmentService->create($request->validated());
        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department created successfully.');
    }

    public function update(UpdateDepartmentRequest $request, Department $department): RedirectResponse
    {
        $this->departmentService->update($department, $request->validated());
        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        $this->departmentService->delete($department);
        return redirect()->route('registrar.departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
```

---

## 6. Routes

Register the routes in `routes/web.php` (or a dedicated route file).

Guidelines:
- Use `Route::prefix()` and `Route::name()` for grouping
- Place inside the `auth` middleware group
- Use route model binding (`{department}`) for implicit binding

```php
Route::middleware('auth')->group(function () {
    Route::prefix('registrar')->name('registrar.')->group(function () {
        Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
        Route::post('departments', [DepartmentController::class, 'store'])->name('departments.store');
        Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('departments/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    });
});
```

Verify: `php artisan route:list --path=registrar`

---

## 7. Views

Create the Blade view files.

### Layout

Use `<x-layouts.portal>` as the wrapper — the sidebar is generated automatically based on `auth()->user()->type`.

```blade
<x-layouts.portal
    title="Page Title"
    header="Page Header"
    subheader="Page subheader"
>
    {{-- content --}}
</x-layouts.portal>
```

### Modals

Place modals inside the component slot. Extract each modal into its own partial under `partials/`:

```
resources/views/portals/{module}/
├── index.blade.php
└── partials/
    ├── create-modal.blade.php
    ├── edit-modal.blade.php
    └── delete-modal.blade.php
```

Use `<dialog class="modal">` (DaisyUI) for modal dialogs. Open with `showModal()` and close with `close()`.

### DB-Driven Dropdowns

For dropdowns populated from the database (departments, programs, school years, etc.), **use a service method** — never query the database directly inside Blade or the controller.

**Service** — add a `getForDropdown()` method:

```php
class DepartmentService
{
    public function getForDropdown(): Collection
    {
        return Department::orderBy('code')->get();
    }
}
```

**Controller** — inject the service and call the method:

```php
use App\Services\DepartmentService;

class SomeController extends Controller
{
    public function __construct(
        private readonly SomeService $someService,
        private readonly DepartmentService $departmentService,
    ) {}

    public function index()
    {
        $items = $this->someService->getAll();
        $departments = $this->departmentService->getForDropdown();

        return view('some.view', compact('items', 'departments'));
    }
}
```

**Blade:**

```blade
<select name="department_id">
    <option value="">Select department</option>
    @foreach($departments as $dept)
        <option value="{{ $dept->id }}" @selected(old('department_id') == $dept->id)>
            {{ $dept->code }} - {{ $dept->description }}
        </option>
    @endforeach
</select>
```

### JavaScript

Keep minimal JS at the bottom of the index view inside `@push('scripts')`. Use a JSON-encoded collection for client-side data lookups:

```blade
@push('scripts')
<script>
    const items = @json($items);

    function editItem(id) {
        const item = items.find(i => i.id === id);
        // populate form fields
        document.getElementById('edit-modal').showModal();
    }
</script>
@endpush
```

---

## 8. Sidebar

The sidebar is centralized in `resources/views/components/layouts/portal.blade.php`.

Add new menu items to the appropriate user type's `$sidebar` array inside the `@php` block at the top of the file.

```php
'registrar' => [
    ['label' => 'Dashboard',  'route' => route('dashboard'), 'icon' => '...'],
    ['label' => 'Departments','route' => route('registrar.departments.index'), 'icon' => '...'],
    // add new item here
],
```

The active state is detected automatically by comparing the current URL to `$item['route']`.

---

---

## 0. Enums (optional, before Migration)

If the module introduces columns with a fixed set of values (status, type, level, etc.), create a backed enum **before** writing the migration. The enum becomes the single source of truth for that column's allowed values.

```bash
php artisan make:enum Enums/Xxx
```

Or create manually at `app/Enums/Xxx.php`.

Position: `app/Enums/Xxx.php`

```php
<?php

namespace App\Enums;

enum Status: string
{
    case Active = 'active';
    case Inactive = 'inactive';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Inactive => 'Inactive',
        };
    }
}
```

### Reference in Form Requests

```php
use App\Enums\Status;
use Illuminate\Validation\Rule;

public function rules(): array
{
    return [
        'status' => ['required', Rule::enum(Status::class)],
    ];
}
```

### Reference in Models (casts)

```php
use App\Enums\Status;

protected function casts(): array
{
    return [
        'status' => Status::class,
    ];
}
```

Now `$model->status` returns the enum instance. Use `->label()` for display and `->value` for the raw string.

### Reference in Views

```blade
<select name="status">
    @foreach(App\Enums\Status::cases() as $s)
        <option value="{{ $s->value }}">{{ $s->label() }}</option>
    @endforeach
</select>
```

---

## Summary — Build Order

```
 0. Enums        → (optional) domain vocabulary (app/Enums/)
 1. Migration    → database table
 2. Model        → Eloquent (fillable, casts, relationships)
 3. Service      → business logic (app/Services/)
 4. Form Request → validation (app/Http/Requests/)
 5. Controller   → wire Request → Service → View (app/Http/Controllers/)
 6. Routes       → register in web.php
 7. Views        → Blade templates under resources/views/portals/
 8. Sidebar      → add nav item in the portal layout
```

Each step produces the foundation the next step needs. Stick to this order and the module will be consistent with the rest of the system.
