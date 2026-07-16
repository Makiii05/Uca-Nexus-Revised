<dialog id="create-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" action="{{ route('registrar.school-years.store') }}">
            @csrf
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">New School Year</h3>
                <button type="button" onclick="document.getElementById('create-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="input input-bordered w-full @error('code') input-error @enderror" placeholder="e.g. AY 2025-2026" required>
                    @error('code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="input input-bordered w-full @error('description') input-error @enderror" placeholder="School Year 2025-2026" required>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Start Year</label>
                        <input type="text" name="start_year" value="{{ old('start_year') }}" class="input input-bordered w-full @error('start_year') input-error @enderror" placeholder="2025" required>
                        @error('start_year') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">End Year</label>
                        <input type="text" name="end_year" value="{{ old('end_year') }}" class="input input-bordered w-full @error('end_year') input-error @enderror" placeholder="2026" required>
                        @error('end_year') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>
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

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('create-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Create</button>
            </div>
        </form>
    </div>
</dialog>
