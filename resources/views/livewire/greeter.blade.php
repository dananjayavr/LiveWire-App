<div>
    {{-- In work, do what you enjoy. --}}

    <form wire:submit="changeGreeting()">
        <div class="mt-2">
            <select
                wire:model.fill="greeting"
                type="text"
                class="p-4 border rounded-md bg-white-700 text-black">
                @foreach($greetings as $item)
                    <option value="{{ $item->greeting }}">{{$item->greeting}}</option>
                @endforeach
            </select>

            <input
                wire:model.live="name"
                type="text"
                class="p-4 border rounded-md bg-white-700 text-black">
        </div>
        <div class="text-red-400">
            @error('name') {{$message}} @enderror
        </div>
        <div class="mt-2">
            <button
                type="submit"
                class="text-white font-medium rounded-md px-4 py-2 bg-blue-600">
                Greet
            </button>
        </div>
    </form>

    @if($greetingMessage != '')
        <div class="mt-5">
            {{$greetingMessage}}
        </div>
    @endif
</div>
