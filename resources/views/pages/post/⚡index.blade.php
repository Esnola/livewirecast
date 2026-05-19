<?php

  use App\Enums\ArticleStatusEnum;
  use App\Models\Article;
  use Livewire\Component;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Computed;
  use App\Models\Post;

  new #[Lazy, Title('Posts')]
  class extends Component {
    public string $sort = 'newest';

    #[Computed]
    public function articles()
    {
      sleep(2);

      return Article::query()
        ->tap(fn($q) => match ($this->sort) {
          'oldest' => $q->orderBy('created_at', 'asc'),
          'popular' => $q->orderBy('views', 'desc'),
          default => $q->latest(),
        })
        ->get();
    }

    public function delete(Post $post)
    {
      $post->delete();
    }
    
    public function statuses()
    {
      return ArticleStatusEnum::cases();
    }

    public function kbses(): array
    {
      return [ '⌘S','⌘P', '⌘A',  ];
    }
  }
?>


@placeholder
<div class="flex flex-col w-full lg:max-w-7xl">
  <div class=" justify-between items-center mb-4">
    <flux:heading size="xl">Record</flux:heading>
    <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
  </div>
  <div class="w-full grid grid-cols-3 gap-4 pr-20">
    @foreach(range(1, 6) as $_)
      <flux:skeleton animate="shimmer" class="min-h-56 rounded-lg"/>
    @endforeach
  </div>
</div>
@endplaceholder

<div class="flex flex-col w-full lg:max-w-7xl">
  <div class="flex justify-between items-center mb-4">
    <div>
      <flux:heading size="xl">Record</flux:heading>
      <flux:text class="mt-2">Manage your blog posts and articles</flux:text>
    </div>
    <flux:dropdown class="">
      <flux:button class="cursor-pointer" icon:trailing="chevron-down">Status Filter</flux:button>
      <flux:menu>
        @foreach( $this->statuses() as $index => $status )
          <flux:menu.item icon="{{ $status->icon() }}" kbd="{{$this->kbses()[$index]}}" class="cursor-pointer">{{ $status->label() }}</flux:menu.item>
        @endforeach
      </flux:menu>
    </flux:dropdown>
  </div>
  <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 pr-20">
    @foreach($this->articles as $post)
      <flux:card class="overflow-hidden min-h-56 flex flex-col justify-between px-4 pt-4 pb-2 shadow-xl shadow-accent">
        <div class="flex flex-col gap-2">
          <flux:heading size="md" class="truncate">{{ $post->title }}</flux:heading>
          <div class="flex items-center w-full justify-between px-4">
            <flux:text class="text-xs font-bold text-stone-600">{{$post->creator}}</flux:text>
            <flux:text class="text-[10px] text-zinc-500">{{ $post->created_at->format('M j, Y') }}</flux:text>
          </div>
          <div>
            <flux:text class="text-[11px] text-zinc-500"><span>$</span> {{$post->formattedPrice()}}</flux:text>
          </div>
          <flux:text class="line-clamp-3 text-xs">{{ $post->content }}</flux:text>
        </div>
        <div class="flex items-center  justify-between">
          <flux:badge class=" flex items-center gap-2 text-xs px-2 py-2 rounded-md {{$post->status->badgeClass()}}">
            <flux:icon name="{{ $post->status->icon() }}" class="size-4" variant="solid"/>
            {{$post->status->label()}}
          </flux:badge>
          <flux:button variant="danger" size="sm" wire:click="delete({{ $post->id }})">Delete</flux:button>
        </div>
      </flux:card>
    @endforeach
  </div>
</div>
