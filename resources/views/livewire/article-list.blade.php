<div class="m.auto w-1/2 mb-4">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="mb-3 flex justify-between items-center">
        <a
            href="/dashboard/articles/create"
            class="p-2 text-blue-400 hover:text-blue-900 rounded-sm"
            wire:navigate
        >
            Create Article
        </a>
        <div>
            <button @class([
                    'text-gray-900 p-2  hover:bg-blue-900 rounded sm',
                    'bg-gray-300' => $showOnlyPublished,
                    'bg-blue-700 text-white' => !$showOnlyPublished,
                    ])
                    wire:click="togglePublished(false)">
                Show All
            </button>
            <button
                @class([
                    'p-2  hover:bg-blue-900 rounded sm',
                    'bg-blue-700 text-white' => $showOnlyPublished,
                    'bg-gray-300' => !$showOnlyPublished,
                    ])
                wire:click="togglePublished(true)">
                Show Published (<livewire:published-count lazy placeholder-text="loading" />)
            </button>
        </div>

    </div>
    @if(session('message'))
        <div class="text-center bg-green-300 text-gray-700">
            {{ session('message') }}
        </div>
    @endif
    <div class="my-3">
        {{ $this->articles->links(data: ['scrollTo' => false]) }}
    </div>
    <table class="w-full">
        <thead class="text-xs uppercase bg-gray-700 text-gray-400">
        <tr>
            <th class="px-6 py-3">Title</th>
            <th class="px-6 py-3"></th>
        </tr>
        </thead>
        <tbody>
         @foreach($this->articles as $article)
             <tr class="border-b bg-gray-800 border-gray-700">
                 <tr wire:key="{{$article->id}}" >
                 <td class="px-6 py-3">
                     <a class="hover:text-blue-400" href="/articles/{{$article->id}}">{{$article->title}}</a>
                 </td>
                 <td class="px-6 py-3">
                     <a href="{{ route('article-update',$article) }}" class="text-gray-800 p-2" wire:navigate
                     >
                         Edit
                     </a>

                     <button class="text-gray-200 p-2 bg-red-700 hover:bg-red-900 rounded-sm"
                             wire:click="$dispatch('confirm-delete', { article: {{ $article }} })"
                     >
                         Delete
                     </button>
                 </td>
             </tr>
         @endforeach
        </tbody>
    </table>
    <livewire:confirm-delete />
</div>

