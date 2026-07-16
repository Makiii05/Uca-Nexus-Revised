<dialog id="delete-modal" class="modal">
    <div class="modal-box max-w-sm">
        <form method="POST" id="delete-form">
            @csrf
            @method('DELETE')
            <div class="text-center">
                <div class="w-12 h-12 mx-auto mb-4 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-2">Delete Department</h3>
                <p class="text-sm text-slate-500 mb-1">Are you sure you want to delete</p>
                <p class="text-sm font-medium text-slate-700" id="delete-target"></p>
                <p class="text-xs text-slate-400 mt-3">This action cannot be undone.</p>
            </div>
            <div class="modal-action justify-center">
                <button type="button" onclick="document.getElementById('delete-modal').close()" class="btn btn-ghost">Cancel</button>
                <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white border-none">Delete</button>
            </div>
        </form>
    </div>
</dialog>
