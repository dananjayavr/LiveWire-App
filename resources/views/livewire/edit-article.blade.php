<div class="m-auto w-1/2 mb-4">
    <h3 class="text-lg text-black mb-3">Edit Article (ID: {{ $form->id }})</h3>
    <form wire:submit="save">
        <div class="mb-3">
            <label wire:dirty.class="text-orange-400" wire:target="form.title" class="block text-black" for="article-title">
                Title<span wire:dirty wire:target="form.title">*</span>
            </label>
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
            <label class="block text-black" for="article-content" wire:dirty.class="text-orange-400" wire:target="form.content">
                Content<span wire:dirty wire:target="form.content">*</span>
            </label>
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
            <label class="block text-black" for="article-content">
                Photo
            </label>
            <div class="flex items-center">
                <input type="file"
                       wire:model="form.photo">
                <div>
                <div class="text-center">
                    @if($form->photo)
                        <img src="{{ $form->photo->temporaryUrl() }}" class="w-1/2 inline" alt="Preview Image"/>
                    @elseif($form->photo_path)
                        <img src="{{ Storage::url($form->photo_path) }}" class="w-1/2 inline" alt="Uploaded Image"/>
                        <div class="mt-2">
                            <button type="button" class="text-white p-2 bg-indigo-700 rounded-sm hover:bg-blue-900"
                            wire:click="downloadPhoto">Download</button>
                        </div>
                    @endif
                </div>
            </div>
                @error('photo') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="flex items-center" wire:dirty.class="text-orange-400" wire:target="form.published">
                <input type="checkbox" name="published" wire:model.boolean="form.published" class="mr-2">
                Published<span wire:dirty wire:target="form.published">*</span>
            </label>
        </div>
        <div class="mb-3">
            <div class="mb-2" wire:dirty.class="text-orange-400" wire:target="form.notifications">
                Notification Options<span wire:dirty wire:target="form.notifications">*</span>
            </div>
            <div class="flex gap-6">
                <label class="flex items-center">
                    <input type="radio" value="true" class="mr-2" wire:model.boolean="form.allowNotifications">
                    Yes
                </label>
                <label class="flex items-center">
                    <input type="radio" value="false" class="mr-2" wire:model.boolean="form.allowNotifications">
                    No
                </label>
            </div>
            <div class="mb-3" x-show="$wire.form.allowNotifications" wire:transition>
                <label class="flex items-center">
                    <input type="checkbox" value="email" class="mr-2" wire:model="form.notifications">
                    Email
                </label>
                <label class="flex items-center">
                    <input type="checkbox" value="sms" class="mr-2" wire:model="form.notifications">
                    SMS
                </label>
                <label class="flex items-center">
                    <input type="checkbox" value="push" class="mr-2" wire:model="form.notifications">
                    Push
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button
                class="text-white p-2 bg-indigo-700  rounded-sm"
                type="submit"
            >
                Save
            </button>
        </div>
    </form>
</div>

