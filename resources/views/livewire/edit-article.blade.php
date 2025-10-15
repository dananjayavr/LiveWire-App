<div class="m-auto w-1/2 mb-4">
    <h3 class="text-lg text-black mb-3">Edit Article</h3>
    <form wire:submit="save">
        <div class="mb-3">
            <label class="block text-black" for="article-title">Title</label>
            <input
                type="text"
                id="article-title"
                class="p-2 w-full border rounded-md bg-gray-100 text-black"
                wire:model="form.title"
            />
            <div>
                @error('title') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="block text-black" for="article-content">Content</label>
            <textarea
                id="article-content"
                class="p-2 w-full border rounded-md bg-gray-100 text-black"
                wire:model="form.content"
            ></textarea>
            <div>
                @error('content') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="flex items-center">
                <input type="checkbox" name="published" wire:model.boolean="form.published" class="mr-2">
                Published
            </label>
        </div>
        <div class="mb-3">
            <div class="mb-2">Notification Options</div>
            <div class="flex gap-6">
                <label class="flex items-center">
                    <input type="radio" value="email" class="mr-2" wire:model="form.notification">
                    Email
                </label>
                <label class="flex items-center">
                    <input type="radio" value="sms" class="mr-2" wire:model="form.notification">
                    SMS
                </label>
                <label class="flex items-center">
                    <input type="radio" value="none" class="mr-2" wire:model="form.notification">
                    None
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button
                class="text-white p-2 bg-indigo-700 hover:bg-indigo-900 rounded-sm"
                type="submit"
            >
                Save
            </button>
        </div>
    </form>
</div>

