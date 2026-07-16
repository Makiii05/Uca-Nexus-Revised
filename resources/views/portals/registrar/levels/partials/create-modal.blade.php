<dialog id="create-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" action="{{ route('registrar.levels.store') }}">
            @csrf
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">New Level</h3>
                <button type="button" onclick="document.getElementById('create-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                    <input type="text" name="code" value="{{ old('code') }}" class="input input-bordered w-full @error('code') input-error @enderror" placeholder="e.g. 1ST" required>
                    @error('code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}" class="input input-bordered w-full @error('description') input-error @enderror" placeholder="1st Year" required>
                    @error('description') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Program</label>
                    <select name="program_id" class="select select-bordered w-full @error('program_id') select-error @enderror" required>
                        <option value="">Select program</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}" @selected(old('program_id') == $prog->id)>{{ $prog->code }} - {{ $prog->description }}</option>
                        @endforeach
                    </select>
                    @error('program_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Order</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="input input-bordered w-full @error('order') input-error @enderror" placeholder="0">
                    @error('order') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('create-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Create</button>
            </div>
        </form>
    </div>
</dialog>
