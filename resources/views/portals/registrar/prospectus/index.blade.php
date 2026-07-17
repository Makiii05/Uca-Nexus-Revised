<x-layouts.portal
    title="Prospectus"
    header="Prospectus"
    subheader="Manage subject mapping per curriculum"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
        <form method="GET" action="{{ route('registrar.prospectus.index') }}" class="flex items-end gap-4 flex-wrap">
            <div class="w-64">
                <label class="block text-sm font-medium text-slate-700 mb-1">Department</label>
                <select name="department_id" id="filter-department" class="select select-bordered w-full" required>
                    <option value="">Select department</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" @selected((int) $departmentId === $dept->id)>
                            {{ $dept->code }} - {{ $dept->description }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="w-64">
                <label class="block text-sm font-medium text-slate-700 mb-1">Curriculum</label>
                <select name="curriculum_id" id="filter-curriculum" class="select select-bordered w-full" required {{ empty($departmentId) ? 'disabled' : '' }}>
                    <option value="">Select curriculum</option>
                    @foreach($curricula as $curr)
                        <option value="{{ $curr->id }}" @selected((int) $curriculumId === $curr->id)>
                            {{ $curr->curriculum }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Search
            </button>
            @if($selectedCurriculum)
                <button type="button" onclick="openCreateModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Subject
                </button>
            @endif
        </form>
    </div>

    @if($prospectus && $prospectus->isNotEmpty())
        @php
            $grouped = $prospectus->groupBy(fn($p) => $p->level->id);
        @endphp
        <div class="space-y-4">
            @foreach($grouped as $levelId => $items)
                @php
                    $level = $items->first()->level;
                    $byTerm = $items->groupBy(fn($p) => $p->term->id);
                    $totalSubjects = $items->count();
                @endphp
                <details class="collapse bg-white rounded-xl shadow-sm border border-slate-200" open>
                    <summary class="collapse-title font-semibold text-slate-800 min-h-0 py-4 px-6 flex items-center gap-2 cursor-pointer">
                        <span>{{ $level->program->code }} - {{ $level->description }}</span>
                        <span class="badge badge-ghost text-xs font-normal">{{ $totalSubjects }} subject{{ $totalSubjects !== 1 ? 's' : '' }}</span>
                    </summary>
                    <div class="collapse-content px-6 pb-4">
                        @foreach($byTerm as $termId => $termItems)
                            @php $term = $termItems->first()->term; @endphp
                            <div class="mb-4 last:mb-0">
                                <h4 class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-2">
                                    {{ $term->description }} ({{ $term->schoolYear->description }})
                                </h4>
                                <div class="overflow-x-auto rounded-lg border border-slate-200">
                                    <table class="table">
                                        <thead>
                                            <tr class="text-slate-500 text-xs uppercase tracking-wider">
                                                <th class="py-3">Subject</th>
                                                <th class="py-3">Units</th>
                                                <th class="py-3">Status</th>
                                                <th class="py-3 text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($termItems as $p)
                                                <tr id="prospectus-{{ $p->id }}" class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                                                    <td class="py-3 font-medium text-slate-800">{{ $p->subject->code }} - {{ $p->subject->description }}</td>
                                                    <td class="py-3 text-slate-600">{{ $p->subject->unit }}</td>
                                                    <td class="py-3">
                                                        <span class="badge text-xs {{ $p->status->badge() }}">
                                                            {{ $p->status->label() }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 text-right">
                                                        <button onclick="editProspectus({{ $p->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                                            Edit
                                                        </button>
                                                        <button onclick="confirmDelete({{ $p->id }}, '{{ $p->subject->code }} - {{ $p->subject->description }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </details>
            @endforeach
        </div>
    @elseif($curriculumId)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p class="text-slate-500">No subjects found for this curriculum. Click "Add Subject" to get started.</p>
        </div>
    @endif

    @include('portals.registrar.prospectus.partials.create-modal')
    @include('portals.registrar.prospectus.partials.edit-modal')
    @include('portals.registrar.prospectus.partials.delete-modal')

    @push('scripts')
    <script>
        const deptSelect = document.getElementById('filter-department');
        const currSelect = document.getElementById('filter-curriculum');
        const selectedCurriculum = @json($selectedCurriculum);
        const curriculaData = @json($curricula);

        deptSelect.addEventListener('change', function () {
            const deptId = this.value;
            currSelect.disabled = true;
            currSelect.innerHTML = '<option value="">Select curriculum</option>';

            if (!deptId) return;

            fetch('{{ route('registrar.prospectus.curricula-by-department') }}?department_id=' + deptId)
                .then(res => res.json())
                .then(data => {
                    data.forEach(c => {
                        const opt = document.createElement('option');
                        opt.value = c.id;
                        opt.textContent = c.curriculum;
                        currSelect.appendChild(opt);
                    });
                    currSelect.disabled = false;
                });
        });

        function openCreateModal() {
            const form = document.getElementById('create-form');
            form.action = '{{ route('registrar.prospectus.store') }}';

            const curriculumId = document.getElementById('filter-curriculum')?.value;
            if (curriculumId) {
                document.getElementById('create-curriculum_id').value = curriculumId;
                document.getElementById('create-curriculum-display').textContent =
                    document.getElementById('filter-curriculum').selectedOptions[0]?.text || '';
            }

            document.getElementById('create-modal').showModal();
        }

        const prospectus = @json($prospectus);

        function editProspectus(id) {
            const p = prospectus ? prospectus.find(item => item.id === id) : null;
            if (!p) return;

            const form = document.getElementById('edit-form');
            form.action = '{{ url('registrar/prospectus') }}/' + id;

            document.getElementById('edit-curriculum_id').value = p.curriculum_id;
            document.getElementById('edit-curriculum-display').textContent =
                p.curriculum?.curriculum || '';

            document.getElementById('edit-level_id').value = p.level_id;
            document.getElementById('edit-term_id').value = p.term_id;
            document.getElementById('edit-subject_id').value = p.subject_id;
            document.getElementById('edit-status').value = p.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, label) {
            const form = document.getElementById('delete-form');
            form.action = '{{ url('registrar/prospectus') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + label + '"';
            document.getElementById('delete-modal').showModal();
        }

        @if(session('new_prospectus_id'))
            document.addEventListener('DOMContentLoaded', function () {
                const el = document.getElementById('prospectus-{{ session('new_prospectus_id') }}');
                if (el) {
                    el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    el.classList.add('bg-primary-50', 'ring-2', 'ring-primary-200');
                    setTimeout(() => el.classList.remove('bg-primary-50', 'ring-2', 'ring-primary-200'), 3000);
                }
            });
        @endif
    </script>
    @endpush
</x-layouts.portal>
