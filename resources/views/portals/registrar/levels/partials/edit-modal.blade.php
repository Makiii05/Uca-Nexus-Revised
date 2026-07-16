<dialog id="edit-modal" class="modal">
    <div class="modal-box max-w-lg">
        <form method="POST" id="edit-form">
            @csrf
            @method('PUT')
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-slate-800">Edit Level</h3>
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
                    <label class="block text-sm font-medium text-slate-700 mb-1">Program</label>
                    <select name="program_id" id="edit-program_id" class="select select-bordered w-full" required>
                        <option value="">Select program</option>
                        @foreach($programs as $prog)
                            <option value="{{ $prog->id }}">{{ $prog->code }} - {{ $prog->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Order</label>
                    <input type="number" name="order" id="edit-order" class="input input-bordered w-full">
                </div>
            </div>

            <div class="modal-action">
                <button type="button" onclick="document.getElementById('edit-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-primary-600 hover:bg-primary-700 text-white border-none">Update</button>
            </div>
        </form>
    </div>
</dialog>
