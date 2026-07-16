<x-layouts.portal
    title="Curricula"
    header="Curricula"
    subheader="Manage curriculum versions"
>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
            <p class="text-sm text-slate-500">{{ $curricula->count() }} curriculum/a</p>
            <button onclick="document.getElementById('create-modal').showModal()" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none btn-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Curriculum
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-slate-500 text-xs uppercase tracking-wider">
                        <th class="py-4">Curriculum</th>
                        <th class="py-4">Department</th>
                        <th class="py-4">Status</th>
                        <th class="py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($curricula as $curriculum)
                        <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 font-medium text-slate-800">{{ $curriculum->curriculum }}</td>
                            <td class="py-3.5 text-slate-600">{{ $curriculum->department->code ?? 'N/A' }}</td>
                            <td class="py-3.5">
                                <span class="badge text-xs {{ $curriculum->status->badge() }}">
                                    {{ $curriculum->status->label() }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right">
                                <button onclick="editCurriculum({{ $curriculum->id }})" class="btn btn-ghost btn-xs text-primary-600 hover:bg-primary-50">
                                    Edit
                                </button>
                                <button onclick="confirmDelete({{ $curriculum->id }}, '{{ $curriculum->curriculum }}')" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                No curricula found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('portals.registrar.curricula.partials.create-modal')
    @include('portals.registrar.curricula.partials.edit-modal')
    @include('portals.registrar.curricula.partials.delete-modal')

    @push('scripts')
    <script>
        const curricula = @json($curricula);

        function editCurriculum(id) {
            const curriculum = curricula.find(c => c.id === id);
            if (!curriculum) return;

            document.getElementById('edit-form').action = '{{ url('registrar/curricula') }}/' + id;
            document.getElementById('edit-curriculum').value = curriculum.curriculum;
            document.getElementById('edit-department_id').value = curriculum.department_id;
            document.getElementById('edit-status').value = curriculum.status;

            document.getElementById('edit-modal').showModal();
        }

        function confirmDelete(id, name) {
            document.getElementById('delete-form').action = '{{ url('registrar/curricula') }}/' + id;
            document.getElementById('delete-target').textContent = '"' + name + '"';
            document.getElementById('delete-modal').showModal();
        }
    </script>
    @endpush
</x-layouts.portal>
