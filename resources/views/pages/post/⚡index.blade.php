<?php

  use App\Enums\StatusEnum;
  use Livewire\Component;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Computed;
  use App\Models\Post;

  new #[Lazy, Title('Posts')]
  class extends Component {
    public string $sort = 'newest';

    #[Computed]
    public function posts()
    {
      sleep(0);

      return Post::query()
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
      return StatusEnum::cases();
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
    @foreach($this->posts as $post)
      <livewire:pages::post.card lazy
               :post="$post"
               :statuses="$this->statuses()"
               :kbses="$this->kbses()"
               wire:delete="delete({{ $post->id }})"/>
    @endforeach
  </div>
</div>
