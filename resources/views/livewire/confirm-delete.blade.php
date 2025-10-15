<div
    x-data
    x-show="$wire.show"
    x-transition.opacity
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div class="bg-gray-800 rounded-lg p-6 shadow-xl w-96">
        <h2 class="text-lg font-bold mb-3 text-white">Confirm Delete</h2>
        <p class="text-gray-300 mb-6">Are you sure you want to delete this item?</p>

        <div class="flex justify-end gap-3">
            <button
                class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded text-white"
                wire:click="close"
            >
                Cancel
            </button>
            <button
                class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white"
                wire:click="dispatch('delete-confirmed')"
            >
                Confirm
            </button>
        </div>
    </div>
</div>
