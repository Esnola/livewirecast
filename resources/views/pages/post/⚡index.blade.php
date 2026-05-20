<?php

  use App\Enums\StatusEnum;
  use Livewire\Attributes\On;
  use Livewire\Component;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Computed;
  use App\Models\Post;

  new #[Lazy, Title('Posts')]
  class extends Component {

    public $selected = [];

    public string $sort = 'newest';

    #[Computed]
    public function posts()
    {
      // sleep(1);

      return Post::query()
        ->tap(fn($q) => match ($this->sort) {
          'oldest' => $q->orderBy('created_at', 'asc'),
          'popular' => $q->orderBy('views', 'desc'),
          default => $q->latest(),
        })
        ->get();
    }

    public function deleteSelected()
    {
      Post::whereIn('id', $this->selected)->delete();
      $this->selected = [];
    }

    public function statuses()
    {
      return StatusEnum::cases();
    }

  }
?>

<div class="flex flex-col">
  <div class="flex justify-between items-center mb-4 pr-20">
    <div>
      <flux:heading size="xl">Livewire 4 - Studio</flux:heading>
      <flux:text class="mt-2 ">
        IMO Livewire takes Blade to the next level.<br/> <span class="italic">It's basically what Blade should be by default.</span>
      </flux:text>
    </div>

    <!-- Counter Selected & Button Delete -->
    <div class="flex items-center gap-4">
      @if(count($this->selected) > 0)
        <div class="max-lg:hidden flex justify-start items-center gap-4">
          <flux:subheading class="whitespace-nowrap">
          </flux:subheading>
          <flux:button variant="danger" icon="trash" wire:click="deleteSelected()" size="sm">
            <span>{{ count($this->selected) }}</span>: Delete
          </flux:button>
        </div>
      @endif
    </div>
    <div class="flex items-center jusitfy-center gap-4">

      <x-status-filter/>

      <flux:select wire:model="post">
        <flux:select.option>Newest</flux:select.option>
        <flux:select.option>Oldest</flux:select.option>
        <flux:select.option>All</flux:select.option>
      </flux:select>
      <flux:button icon="plus" variant="primary" href="{{ route('post.create') }}">New Post</flux:button>
    </div>
  </div>

  <div class="grid  md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4 pr-20">
    @foreach($this->posts as $post)
      <div class="relative">
        <livewire:pages::post.card
                :post="$post"
                :wire:key="$post->id"
                :lazy.bundle="$loop->iteration > 9"
        >

        <livewire:slot name="checkbox">
          <flux:checkbox
                  class="mt-0! cursor-pointer"
                  wire:model.live="selected"
                  value="{{ $post->id }}"
                  wire:key="select-{{ $post->id }}"
          /></livewire:slot>
        </livewire:pages::post.card>
      </div>
    @endforeach
  </div>
</div>
