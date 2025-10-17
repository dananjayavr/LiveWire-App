<div class="m-auto w-1/2">
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h2 class="text-2xl text-black">
        {{$article->title}}
    </h2>
    @if($article->photo_path)
        <img src="{{ Storage::url($article->photo_path) }}" alt="Uploaded Image" class="p-4">
    @endif
    <div class="mt-4">
        {{$article->content}}
    </div>
</div>
