<?php

  use App\Models\Post;
  use Livewire\Attributes\Layout;
  use Livewire\Component;

  new #[Layout('layouts::app', ['title' => 'Create post'])]
  class extends Component {
    public string $title = '';
    public string $content = '';

    public function save()
    {
      sleep(1);
      Post::create($this->validate([
        'title' => 'required|min:3',
        'content' => 'required'
      ]));
      $this->redirect('/');
    }
  }
?>
<div>
  <form action="{{ route('post.create') }}" method="POST"
        wire:submit="save" class="w-96 space-y-6">
    @csrf
    <flux:heading size="xl">Create post</flux:heading>
    <flux:input wire:model="title" label="Title" placeholder="Title" class="w-full"/>
    <flux:textarea wire:model="content" label="Content" placeholder="Write here..." class="w-full"/>
    <flux:radio.group wire:model="status" variant="cards" class="max-sm:flex-col">
      <flux:radio value="draft" label="Draft" description="Post will be saved as draft" checked/>
      <flux:radio value="published" label="Published" description="Post will be published immediately"/>
    </flux:radio.group>

    <div class="flex justify-end">
      <button type="submit"
              class="data-loading:opacity-50 flex gap-2 bg-gray-400 text-white px-4 py-2 rounded-md cursor-pointer">
        Create Post
        <flux:icon.loading variant="solid" class="not-in-data-loading:hidden"/>
      </button>
    </div>
  </form>
</div>
