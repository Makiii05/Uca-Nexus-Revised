<x-layouts.portal
    title="School Years"
    header="School Years"
    subheader="Manage school years"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">{{ $schoolYears->count() }} school year(s)</p>
            <button onclick="document.getElementById('create-modal').showModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add School Year
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="py-4">Code</th>
                        <th class="py-4">Description</th>
                        <th class="py-4">Start Year</th>
                        <th class="py-4">End Year</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schoolYears as $sy)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 font-medium text-slate-800">{{ $sy->code }}</td>
                            <td class="py-3.5 text-slate-600">{{ $sy->description }}</td>
                            <td class="py-3.5">{{ $sy->start_year }}</td>
                            <td class="py-3.5">{{ $sy->end_year }}</td>
                            <td class="py-3.5">
                                <span class="badge text-xs {{ $sy->status->badge() }}">
                                    {{ $sy->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <button onclick="editSchoolYear({{ $sy->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $sy->id }}, '{{ $sy->code }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                No school years found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('portals.registrar.school-years.partials.create-modal')
    @include('portals.registrar.school-years.partials.edit-modal')
    @include('portals.registrar.school-years.partials.delete-modal')

    @push('scripts')
    <script>
        const schoolYears = @json($schoolYears);

        function editSchoolYear(id) {
            const sy = schoolYears.find(s => s.id === id);
            if (!sy) return;

            document.getElementById('edit-form').action = '{{ url('registrar/school-years') }}/' + id;
            document.getElementById('edit-code').value = sy.code;
            document.getElementById('edit-description').value = sy.description;
            document.getElementById('edit-start_year').value = sy.start_year;
            document.getElementById('edit-end_year').value = sy.end_year;
            document.getElementById('edit-status').value = sy.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, code) {
            document.getElementById('delete-form').action = '{{ url('registrar/school-years') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + code + '"';
            document.getElementById('delete-modal').showModal();
        }
    </script>
    @endpush
</x-layouts.portal>
