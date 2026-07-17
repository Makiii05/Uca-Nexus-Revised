<dialog id="create-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" id="create-form" action="{{ route('registrar.prospectus.store') }}">
            @csrf
            <input type="hidden" name="department_id" value="{{ $departmentId ?? '' }}">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">Add Subject to Prospectus</h3>
                <button type="button" onclick="document.getElementById('create-modal').close()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Curriculum</label>
                    <input type="hidden" name="curriculum_id" id="create-curriculum_id" value="{{ $curriculumId ?? '' }}">
                    <p class="text-sm text-slate-600 py-2 px-3 bg-slate-50 rounded-lg" id="create-curriculum-display">
                        {{ $selectedCurriculum->curriculum ?? 'Not selected' }}
                    </p>
                    @error('curriculum_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Year Level</label>
                    <select name="level_id" class="select select-bordered w-full @error('level_id') select-error @enderror" required>
                        <option value="">Select year level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" @selected(old('level_id') == $level->id)>
                                {{ $level->program->code }} - {{ $level->description }}
                            </option>
                        @endforeach
                    </select>
                    @error('level_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Academic Term</label>
                    <select name="term_id" class="select select-bordered w-full @error('term_id') select-error @enderror" required>
                        <option value="">Select academic term</option>
                        @foreach($terms as $term)
                            <option value="{{ $term->id }}" @selected(old('term_id') == $term->id)>
                                {{ $term->description }} ({{ $term->schoolYear->description }})
                            </option>
                        @endforeach
                    </select>
                    @error('term_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Subject</label>
                    <select name="subject_id" class="select select-bordered w-full @error('subject_id') select-error @enderror" required>
                        <option value="">Select subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
                                {{ $subject->code }} - {{ $subject->description }} ({{ $subject->unit }} units)
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
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
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Add Subject</button>
            </div>
        </form>
    </div>
</dialog>
