<?php

  use App\Models\Post;
  use Livewire\Component;

new class extends Component {
  public Post $post;
  
  public function mount()
  {
    usleep(100*1000);
  }
};

?>
@placeholder
<flux:skeleton animate="shimmer" class="min-h-56 rounded-lg"/>
@endplaceholder

<flux:card  {{ $attributes->class('overflow-hidden min-h-56 flex flex-col justify-between px-4 pt-4 pb-2 transition duration-300 ease-in-out hover:shadow-xl shadow-accent hover:scale-105') }} >
  <div class="flex flex-col gap-2">
    <flux:heading size="md" class="truncate">{{ $post->title }}</flux:heading>
    <div class="flex items-center w-full justify-between ">
      <flux:text class="flex items-center font-bold text-stone-600">
        <span class="text-[8px]">Author:</span> {{$post->creator}} {{$post->status}}
      </flux:text>
      <div class="flex flex-col items-center jusitfy-center">
        <flux:text class="text-[8px] text-zinc-500">
          <span class="font-semibold">Start: </span>{{ $post->created_at->format('j-m, Y') }}
        </flux:text>
        <flux:text class="text-[8px] text-zinc-500">
          <span class="font-semibold">End: </span>{{ $post->updated_at->format('j-m, Y') }}
        </flux:text>
      </div>
    </div>
    <div>
      <flux:badge class="text-[11px] text-stone-600 border border-stone-400 bg-stone-100!"><span class="font-semibold text-sm ">$</span> {{$post->formattedPrice()}}</flux:badge>
    </div>
    <flux:text class="line-clamp-9 text-xs">{{ $post->content }}</flux:text>
  </div>
  {{--? BAGDES VIEWS, LIKES AND DISLIKES --}}
  <div class="w-full flex items-center justify-center gap-2 my-6">
    <flux:badge class="text-[10px] text-blue-400! border border-blue-300 bg-blue-50!">
      <flux:icon.eye class="size-4 mr-2" />{{$post->views}}</flux:badge>
    <flux:badge class="text-[10px] text-green-400! border border-green-300 bg-green-50!">
      <flux:icon.hand-thumb-up class="size-4 mr-2" />{{$post->likes}}</flux:badge>
    <flux:badge class="text-[10px] text-red-400! border border-red-300 bg-red-50!">
      <flux:icon.hand-thumb-down class="size-4 mr-2" />
      {{$post->dislikes}}</flux:badge>
  </div>
  <div class="flex items-center  justify-between">
    <flux:badge class="border flex tems-center gap-2 text-xs px-2 py-2 rounded-md {{$post->status->badgeClass()}}">
      <flux:icon name="{{ $post->status->icon() }}" class="size-4" variant="solid"/>
      {{$post->status->label()}}
    </flux:badge>

    <flux:button variant="danger" size="sm" wire:click="delete({{ $post->id }})">Delete</flux:button>
  </div>
</flux:card>
