<x-layouts.portal
    title="Academic Terms"
    header="Academic Terms"
    subheader="Manage academic terms"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">{{ $academicTerms->count() }} term(s)</p>
            <button onclick="document.getElementById('create-modal').showModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Term
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="py-4">Code</th>
                        <th class="py-4">Description</th>
                        <th class="py-4">Type</th>
                        <th class="py-4">School Year</th>
                        <th class="py-4">Department</th>
                        <th class="py-4">Start Date</th>
                        <th class="py-4">End Date</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($academicTerms as $term)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 font-medium text-slate-800">{{ $term->code }}</td>
                            <td class="py-3.5 text-slate-600">{{ $term->description }}</td>
                            <td class="py-3.5 capitalize">{{ $term->type->label() }}</td>
                            <td class="py-3.5">{{ $term->schoolYear->code ?? 'N/A' }}</td>
                            <td class="py-3.5">{{ $term->department->code ?? 'All' }}</td>
                            <td class="py-3.5">{{ $term->start_date->format('M d, Y') }}</td>
                            <td class="py-3.5">{{ $term->end_date->format('M d, Y') }}</td>
                            <td class="py-3.5">
                                <span class="badge text-xs {{ $term->status->badge() }}">
                                    {{ $term->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <button onclick="editTerm({{ $term->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $term->id }}, '{{ $term->code }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                No academic terms found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('portals.registrar.academic-terms.partials.create-modal')
    @include('portals.registrar.academic-terms.partials.edit-modal')
    @include('portals.registrar.academic-terms.partials.delete-modal')

    @push('scripts')
    <script>
        const terms = @json($academicTerms);

        function editTerm(id) {
            const term = terms.find(t => t.id === id);
            if (!term) return;

            document.getElementById('edit-form').action = '{{ url('registrar/academic-terms') }}/' + id;
            document.getElementById('edit-code').value = term.code;
            document.getElementById('edit-description').value = term.description;
            document.getElementById('edit-type').value = term.type;
            document.getElementById('edit-school_year_id').value = term.school_year_id;
            document.getElementById('edit-department_id').value = term.department_id || '';
            document.getElementById('edit-start_date').value = term.start_date?.split('T')[0] || '';
            document.getElementById('edit-end_date').value = term.end_date?.split('T')[0] || '';
            document.getElementById('edit-status').value = term.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, code) {
            document.getElementById('delete-form').action = '{{ url('registrar/academic-terms') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + code + '"';
            document.getElementById('delete-modal').showModal();
        }
    </script>
    @endpush
</x-layouts.portal>
