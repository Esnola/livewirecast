<?php

  use App\Models\Post;
  use Livewire\Component;

new class extends Component {
  public Post $post;

/*  public function mount()
  {
    usleep(100*1000);
  }*/
};

?>
@placeholder
<flux:skeleton animate="shimmer" class="min-h-56 rounded-lg"/>
@endplaceholder

<flux:card  {{ $attributes->class('overflow-hidden min-h-56 flex flex-col justify-between px-4 pt-4 pb-2') }} post-id="{{ $post->id }}" >

  <div class="flex items-center justify-between">
    @if($slots->has('checkbox'))
      {{ $slots['checkbox'] }}
    <flux:badge class="text-[8px] text-zinc-500">
      <span class="font-semibold">Views: </span>{{ $post->views }}
    </flux:badge>
      <flux:badge class="text-[8px] text-zinc-500">
        <span class="font-semibold">Start: </span>{{ $post->created_at->format('j-m, Y') }}
      </flux:badge>
    @endcanany
  </div>

  <div class="flex flex-col gap-3 mt-6">
    <div class="flex flex-col gap-2" >
    <!-- Title -->
    <flux:heading size="md" class="truncate"> {{ $post->title }} </flux:heading>
      <!-- Author -->
      <flux:text class="flex items-center font-bold text-stone-600"> {{$post->creator}}</flux:text>
    </div>
      <flux:text class="line-clamp-9 text-xs">{{ $post->content }}</flux:text>

    <div class="flex items-center justify-between mt-8">
         <x-status-badge :badge-class="$post->status->badgeClass()" :status-icon="$post->status->icon()" :status-label="$post->status->label()"/>
          <x-status-filter  title="Change Status" :statusValue="$post->status->value"/>
    </div>
  </div>

</flux:card>
