<dialog id="edit-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" id="edit-form">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">Edit Department</h3>
                <button type="button" onclick="document.getElementById('edit-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Code</label>
                    <input type="text" name="code" id="edit-code" class="input input-bordered w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                    <input type="text" name="description" id="edit-description" class="input input-bordered w-full" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Education Level</label>
                    <select name="education_level" id="edit-education_level" class="select select-bordered w-full">
                        <option value="">Select level</option>
                        @foreach(App\Enums\EducationLevel::cases() as $level)
                            <option value="{{ $level->value }}">{{ $level->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                    <select name="status" id="edit-status" class="select select-bordered w-full" required>
                        @foreach(App\Enums\Status::cases() as $s)
                            <option value="{{ $s->value }}">{{ $s->label() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('edit-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Update</button>
            </div>
        </form>
    </div>
</dialog>
