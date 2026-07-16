<dialog id="create-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" action="{{ route('registrar.academic-terms.store') }}">
            @csrf
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">New Academic Term</h3>
                <button type="button" onclick="document.getElementById('create-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="input input-bordered w-full @error('code') input-error @enderror" placeholder="e.g. 2025-1ST" required>
                    @error('code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="input input-bordered w-full @error('description') input-error @enderror" placeholder="1st Semester AY 2025-2026" required>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Type</label>
                        <select name="type" class="select select-bordered w-full @error('type') select-error @enderror" required>
                            @foreach(App\Enums\TermType::cases() as $tt)
                                <option value="{{ $tt->value }}" @selected(old('type') === $tt->value)>{{ $tt->label() }}</option>
                            @endforeach
                        </select>
                        @error('type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status" class="select select-bordered w-full @error('status') select-error @enderror" required>
                            @foreach(App\Enums\Status::cases() as $s)
                                <option value="{{ $s->value }}" @selected(old('status', 'active') === $s->value)>{{ $s->label() }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>  
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">School Year</label>
                    <select name="school_year_id" class="select select-bordered w-full @error('school_year_id') select-error @enderror" required>
                        <option value="">Select school year</option>
                        @foreach($schoolYears as $sy)
                            <option value="{{ $sy->id }}" @selected(old('school_year_id') == $sy->id)>{{ $sy->code }} - {{ $sy->description }}</option>
                        @endforeach
                    </select>
                    @error('school_year_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                    <select name="department_id" class="select select-bordered w-full">
                        <option value="">All departments</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" @selected(old('department_id') == $dept->id)>{{ $dept->code }} - {{ $dept->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="input input-bordered w-full @error('start_date') input-error @enderror" required>
                        @error('start_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="input input-bordered w-full @error('end_date') input-error @enderror" required>
                        @error('end_date') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('create-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Create</button>
            </div>
        </form>
    </div>
</dialog>
