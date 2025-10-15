<div>
    {{-- In work, do what you enjoy. --}}

    <form>
        <div class="mt-2 w-full p-4">
            <input
                placeholder="{{ $placeholder }}"
                type="text"
                class="p-4 w-full border rounded-md bg-white-700 text-black"
                wire:model.live.debounce="searchText"
            >
{{--            <button
                class="text-white font-medium rounded-md p-4 bg-indigo-600 disabled:bg-indigo-200"
                wire:click.prevent="clear()"
                {{ empty($searchText) ? 'disabled' : '' }}
            >
                Clear
            </button>--}}
        </div>
    </form>
    <livewire:search-results :results="$results" :show="!empty($searchText)"/>
</div>
