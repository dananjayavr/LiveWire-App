<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main x-data x-on:click="$dispatch('search:clear-results')">
        <livewire:search placeholder="type something to search"/>
        <hr />
        <div class="pt-5">
            {{ $slot }}
        </div>

    </flux:main>
</x-layouts.app.sidebar>
