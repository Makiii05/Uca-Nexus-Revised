<dialog id="create-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" action="{{ route('registrar.subjects.store') }}">
            @csrf
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">New Subject</h3>
                <button type="button" onclick="document.getElementById('create-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                        <input type="text" name="code" value="{{ old('code') }}" class="input input-bordered w-full @error('code') input-error @enderror" placeholder="e.g. MATH101" required>
                        @error('code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Unit</label>
                        <input type="number" name="unit" value="{{ old('unit') }}" class="input input-bordered w-full @error('unit') input-error @enderror" placeholder="3" min="0" required>
                        @error('unit') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="input input-bordered w-full @error('description') input-error @enderror" placeholder="Calculus I" required>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lecture Hours</label>
                        <input type="number" name="lech" value="{{ old('lech', 0) }}" class="input input-bordered w-full @error('lech') input-error @enderror" min="0" required>
                        @error('lech') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lecture Units</label>
                        <input type="number" name="lecu" value="{{ old('lecu', 0) }}" class="input input-bordered w-full @error('lecu') input-error @enderror" min="0" required>
                        @error('lecu') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lab Hours</label>
                        <input type="number" name="labh" value="{{ old('labh', 0) }}" class="input input-bordered w-full @error('labh') input-error @enderror" min="0" required>
                        @error('labh') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Lab Units</label>
                        <input type="number" name="labu" value="{{ old('labu', 0) }}" class="input input-bordered w-full @error('labu') input-error @enderror" min="0" required>
                        @error('labu') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Type</label>
                    <select name="type" class="select select-bordered w-full @error('type') select-error @enderror" required>
                        @foreach(App\Enums\SubjectType::cases() as $t)
                            <option value="{{ $t->value }}" @selected(old('type') === $t->value)>{{ $t->label() }}</option>
                        @endforeach
                    </select>
                    @error('type') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Education Level</label>
                        <select name="education_level" class="select select-bordered w-full">
                            <option value="">Select level</option>
                            @foreach(App\Enums\EducationLevel::cases() as $level)
                                <option value="{{ $level->value }}" @selected(old('education_level', 'college') === $level->value)>{{ $level->label() }}</option>
                            @endforeach
                        </select>
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
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('create-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Create</button>
            </div>
        </form>
    </div>
</dialog>
