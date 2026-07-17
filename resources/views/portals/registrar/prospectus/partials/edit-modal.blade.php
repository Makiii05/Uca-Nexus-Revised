<dialog id="edit-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" id="edit-form">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">Edit Prospectus Entry</h3>
                <button type="button" onclick="document.getElementById('edit-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Curriculum</label>
                    <input type="hidden" name="curriculum_id" id="edit-curriculum_id">
                    <p class="text-sm text-slate-600 py-2 px-3 bg-slate-50 rounded-lg" id="edit-curriculum-display"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Year Level</label>
                    <select name="level_id" id="edit-level_id" class="select select-bordered w-full" required>
                        <option value="">Select year level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->program->code }} - {{ $level->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Academic Term</label>
                    <select name="term_id" id="edit-term_id" class="select select-bordered w-full" required>
                        <option value="">Select academic term</option>
                        @foreach($terms as $term)
                            <option value="{{ $term->id }}">{{ $term->description }} ({{ $term->schoolYear->description }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                    <select name="subject_id" id="edit-subject_id" class="select select-bordered w-full" required>
                        <option value="">Select subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->description }} ({{ $subject->unit }} units)</option>
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
