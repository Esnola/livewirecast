
<div class="grid grid-cols-3 gap-4 pl-6 pr-20">
  @foreach($articles as $article)

    <div card class="flex flex-col gap-6 justify-between border border-gray-200 p-4 rounded-md">
        <div class="flex-1 overflow-hidden">
          <h4 class="text-md text-gray-600 truncate">{{$article->title}}</h4>
          <p class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }}</p>
          <p class="mt-4  text-xs text-gray-400 line-clamp-4">
            {{ $article->content  }}y.<br>
            This action cannot be undone.
          </p>
        </div>

      <div class="flex gap-4 mt-4">
        <div class="{{$article->status->badgeClass()}} flex items-center gap-2 px-2 py-1 rounded-full text-xs font-semibold">
          <flux:icon name="{{ $article->status->icon() }}" variant="solid" class="h-4 w-4" />
          {{$article->status->label()}}
        </div>
      </div>
    </div>

  @endforeach
</div>
