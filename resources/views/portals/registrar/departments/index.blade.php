<x-layouts.portal
    title="Departments"
    header="Departments"
    subheader="Manage academic departments"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">{{ $departments->count() }} department(s)</p>
            <button onclick="document.getElementById('create-modal').showModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Department
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="py-4">Code</th>
                        <th class="py-4">Description</th>
                        <th class="py-4">Education Level</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($departments as $dept)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 font-medium text-slate-800">{{ $dept->code }}</td>
                            <td class="py-3.5 text-slate-600">{{ $dept->description }}</td>
                            <td class="py-3.5">{{ $dept->education_level?->label() ?? 'N/A' }}</td>
                            <td class="py-3.5">
                                <span class="badge text-xs {{ $dept->status->badge() }}">
                                    {{ $dept->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <button onclick="editDepartment({{ $dept->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $dept->id }}, '{{ $dept->code }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                No departments found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('portals.registrar.departments.partials.create-modal')
    @include('portals.registrar.departments.partials.edit-modal')
    @include('portals.registrar.departments.partials.delete-modal')

    @push('scripts')
    <script>
        const departments = @json($departments);

        function editDepartment(id) {
            const dept = departments.find(d => d.id === id);
            if (!dept) return;

            document.getElementById('edit-form').action = '{{ url('registrar/departments') }}/' + id;
            document.getElementById('edit-code').value = dept.code;
            document.getElementById('edit-description').value = dept.description;
            document.getElementById('edit-education_level').value = dept.education_level || '';
            document.getElementById('edit-status').value = dept.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, code) {
            document.getElementById('delete-form').action = '{{ url('registrar/departments') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + code + '"';
            document.getElementById('delete-modal').showModal();
        }
    </script>
    @endpush
</x-layouts.portal>
