<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="mt-4 p-4 mb-4 absolute rounded-md bg-white border-b-indigo-200">
        <div class="absolute top-0 right-0 pt-1 pr-3">
            <button type="button" wire:click="dispatch('search:clear-results')">x</button>
        </div>
        @if(count($results) == 0)
            <p>
                No results found.
            </p>
        @endif
        @foreach($results as $result)
            <div class="pt-2" wire:key="{{ $result->id }}">
                <a wire:navigate href="/articles/{{$result->id}}">{{$result->title}}</a>
            </div>
        @endforeach
    </div>
</div>
