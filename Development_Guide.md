# Laravel Enterprise Development Guide

> Personal project standard for this Enrollment System.

## Architecture

    Request
      ↓
    Middleware
      ↓
    Controller
      ↓
    Form Request
      ↓
    Service
      ↓
    Model (Eloquent)
      ↓
    Database

Business rules belong in **Services**, HTTP concerns belong in
**Controllers**.

------------------------------------------------------------------------

# Recommended Project Structure

``` text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Web/
│   │   │   ├── Admission/
│   │   │   ├── Academic/
│   │   │   ├── Enrollment/
│   │   │   ├── Accounting/
│   │   │   ├── Grading/
│   │   │   ├── Student/
│   │   │   ├── Teacher/
│   │   │   ├── Website/
│   │   │   └── Dashboard/
│   │   ├── Api/
│   │   ├── Requests/
│   │   └── Middleware/
│   ├── Models/
│   ├── Services/
│   ├── Policies/
│   ├── Notifications/
│   ├── Mail/
│   ├── Traits/
│   └── Helpers/
│
resources/
├── views/
│   ├── layouts/
│   ├── components/
│   ├── partials/
│   ├── website/
│   ├── portals/
│   │   ├── registrar/
│   │   ├── teacher/
│   │   └── student/
│   ├── pdf/
│   ├── emails/
│   └── errors/
│
├── js/
├── css/
│
routes/
├── web.php
├── api.php
├── admission.php
├── academic.php
├── enrollment.php
├── accounting.php
├── grading.php
├── student.php
├── teacher.php
└── website.php
```

## Views

Separate first by application:

-   website
-   portals/registrar
-   portals/teacher
-   portals/student

Inside each portal, organize by feature:

    students/
    teachers/
    enrollment/
    grading/
    reports/
    settings/

Never place dozens of unrelated Blade files in one folder.

------------------------------------------------------------------------

# Controller Rules

Controllers should:

-   Receive Request
-   Call Service
-   Return View or JSON
-   Never contain business logic

Example:

``` php
public function store(StoreStudentRequest $request)
{
    $this->studentService->store($request->validated());

    return redirect()
        ->route('students.index')
        ->with('success','Student created.');
}
```

Avoid: - Database transactions - Complex calculations - Email sending -
PDF generation - Large loops

Those belong in Services.

------------------------------------------------------------------------

# Service Rules

Services contain business logic.

Example responsibilities:

-   Create Student
-   Enroll Student
-   Compute Grades
-   Generate Assessment
-   Generate PDF
-   Process Payments

Example:

``` php
class StudentService
{
    public function store(array $data)
    {
        // create records
        // upload image
        // create account
        // return model
    }
}
```

------------------------------------------------------------------------

# Model Rules

Models should contain:

-   Relationships
-   Accessors
-   Mutators
-   Scopes
-   Small helper methods

Avoid putting workflow/business logic in Models.

------------------------------------------------------------------------

# Form Requests

Validation always belongs here.

    Http/Requests/
        Student/
            StoreStudentRequest.php
            UpdateStudentRequest.php

Controllers should not call `$request->validate()` directly.

------------------------------------------------------------------------

# API Controllers

API controllers only return JSON.

    return StudentResource::make($student);

Never return Blade views from API controllers.

------------------------------------------------------------------------

# Blade Components

Reusable UI belongs in components:

    button.blade.php
    input.blade.php
    modal.blade.php
    table.blade.php
    badge.blade.php
    navbar.blade.php
    sidebar.blade.php

------------------------------------------------------------------------

# Naming Convention

Controllers: - StudentController - EnrollmentController

Services: - StudentService - GradeService

Requests: - StoreStudentRequest - UpdateStudentRequest

Policies: - StudentPolicy

Models: - Student - Subject - Enrollment

------------------------------------------------------------------------

# Folder Responsibility

  Folder         Responsibility
  -------------- --------------------------------
  Controller     HTTP only
  Service        Business logic
  Model          Database representation
  Request        Validation
  Middleware     Authentication / Authorization
  Policy         Permissions
  Mail           Emails
  Notification   User notifications
  Jobs           Long-running tasks
  Views          Presentation
  Components     Reusable UI
  Enums          Domain vocabulary (string-backed PHP 8.1 enums)

------------------------------------------------------------------------

# Enums

Use PHP 8.1 backed enums for dropdown values instead of hardcoded strings.
Always use `Rule::enum()` in Form Requests for validation and `protected function casts()` in Models for automatic conversion.

## Pattern

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

    // Optional: return a DaisyUI badge class based on the value
    public function badge(): string
    {
        return match ($this) {
            self::Active => 'badge-success',
            self::Inactive => 'badge-ghost',
        };
    }
}
```

## Usage in Form Requests

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

## Usage in Models

```php
use App\Enums\Status;

protected function casts(): array
{
    return [
        'status' => Status::class,
    ];
}
```

Now `$model->status` returns the enum instance — call `->label()` for display, `->badge()` for CSS class, `->value` for the raw string.

## Usage in Blade

```blade
{{-- Dropdown from enum --}}
<select name="status">
    @foreach(App\Enums\Status::cases() as $s)
        <option value="{{ $s->value }}" @selected(old('status') === $s->value)>
            {{ $s->label() }}
        </option>
    @endforeach
</select>

{{-- Badge --}}
<span class="badge text-xs {{ $entity->status->badge() }}">
    {{ $entity->status->label() }}
</span>
```

## DB-Driven Dropdowns

For dropdowns populated from the database (e.g. departments, programs, school years):

**Never query the database directly in Blade or the controller.** Create a `getForDropdown()` method on the corresponding service, then inject the service into the controller.

### Service

```php
class DepartmentService
{
    public function getForDropdown(): Collection
    {
        return Department::orderBy('code')->get();
    }
}
```

### Controller

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

### Blade

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

This keeps the view passive and the controller responsible for wiring, with data logic centralized in services.

---

# Development Checklist

Before writing code ask:

-   Which feature/domain am I working on?
-   Does validation belong in a Form Request?
-   Can this logic go into a Service?
-   Is this reusable?
-   Is this UI reusable as a Blade Component?
-   Should this be an API endpoint instead of a Web controller?
-   Am I duplicating code?

If a controller exceeds \~100 lines, consider extracting logic into a
Service.

Keep controllers thin, services focused, and views free of business
logic.

-----------------------------------------------------------------------

# Design System

## Color Palette

The system uses a **blue and white** color scheme.

| Token              | Hex       | Tailwind        | Usage                              |
|--------------------|-----------|-----------------|------------------------------------|
| Primary 50         | `#eff6ff` | `blue-50`       | Light backgrounds                  |
| Primary 100        | `#dbeafe` | `blue-100`      | Stats card icon backgrounds        |
| Primary 200        | `#bfdbfe` | `blue-200`      | Hover / light accents              |
| Primary 300        | `#93c5fd` | `blue-300`      | Muted text on dark                 |
| Primary 400        | `#60a5fa` | `blue-400`      | Accent on sidebar / brand          |
| Primary 500        | `#3b82f6` | `blue-500`      | Primary buttons, links             |
| Primary 600        | `#2563eb` | `blue-600`      | Button hover, active states        |
| Primary 700        | `#1d4ed8` | `blue-700`      | Deep hover                         |
| Primary 800        | `#1e40af` | `blue-800`      | Dark accents                       |
| Primary 900        | `#1e3a8a` | `blue-900`      | Login gradient, deep backgrounds   |
| Sidebar            | `#0f172a` | `slate-900`     | Portal sidebar background          |
| Sidebar Hover      | `#1e293b` | `slate-800`     | Sidebar item hover                 |
| Sidebar Active     | `#1e40af` | `blue-800`      | Sidebar active item                |
| Content Background | `#f1f5f9` | `slate-100`     | Main page background               |
| Card Background    | `#ffffff` | `white`         | Cards, headers, modals             |
| Text Primary       | `#1e293b` | `slate-800`     | Body text on white                 |
| Text Muted         | `#64748b` | `slate-500`     | Secondary / hint text              |

## Logo / Branding

Replace the placeholder branding in portal layouts with the official UCA
logo.

```blade
{{-- resources/views/components/layouts/portal.blade.php --}}
{{-- Replace the text logo with: --}}
<img src="{{ asset('images/uca-logo.png') }}" alt="UCA" class="h-8">
```

## Portal Layout Structure

```
resources/views/
├── components/
│   └── layouts/
│       └── portal.blade.php      # Shared sidebar + header layout (loaded via <x-layouts.portal>)
├── portals/
│   ├── admin/
│   │   └── dashboard.blade.php
│   ├── registrar/
│   │   └── dashboard.blade.php
│   ├── accounting/
│   │   └── dashboard.blade.php
│   └── admission/
│       └── dashboard.blade.php
└── auth/
    ├── login-admin.blade.php
    ├── login-registrar.blade.php
    ├── login-accounting.blade.php
    └── login-admission.blade.php
```
