<x-layouts.portal
    title="Subjects"
    header="Subjects"
    subheader="Manage academic subjects"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">{{ $subjects->count() }} subject(s)</p>
            <button onclick="document.getElementById('create-modal').showModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Subject
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="py-4">Code</th>
                        <th class="py-4">Description</th>
                        <th class="py-4">Unit</th>
                        <th class="py-4">Type</th>
                        <th class="py-4">Education Level</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subjects as $subject)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 font-medium text-slate-800">{{ $subject->code }}</td>
                            <td class="py-3.5 text-slate-600">{{ $subject->description }}</td>
                            <td class="py-3.5">{{ $subject->unit }}</td>
                            <td class="py-3.5">{{ $subject->type->label() }}</td>
                            <td class="py-3.5">{{ $subject->education_level?->label() ?? 'N/A' }}</td>
                            <td class="py-3.5">
                                <span class="badge text-xs {{ $subject->status->badge() }}">
                                    {{ $subject->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <button onclick="editSubject({{ $subject->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $subject->id }}, '{{ $subject->code }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                No subjects found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('portals.registrar.subjects.partials.create-modal')
    @include('portals.registrar.subjects.partials.edit-modal')
    @include('portals.registrar.subjects.partials.delete-modal')

    @push('scripts')
    <script>
        const subjects = @json($subjects);

        function editSubject(id) {
            const subject = subjects.find(s => s.id === id);
            if (!subject) return;

            document.getElementById('edit-form').action = '{{ url('registrar/subjects') }}/' + id;
            document.getElementById('edit-code').value = subject.code;
            document.getElementById('edit-description').value = subject.description;
            document.getElementById('edit-unit').value = subject.unit;
            document.getElementById('edit-lech').value = subject.lech;
            document.getElementById('edit-lecu').value = subject.lecu;
            document.getElementById('edit-labh').value = subject.labh;
            document.getElementById('edit-labu').value = subject.labu;
            document.getElementById('edit-type').value = subject.type;
            document.getElementById('edit-education_level').value = subject.education_level || '';
            document.getElementById('edit-status').value = subject.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, code) {
            document.getElementById('delete-form').action = '{{ url('registrar/subjects') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + code + '"';
            document.getElementById('delete-modal').showModal();
        }
    </script>
    @endpush
</x-layouts.portal>
