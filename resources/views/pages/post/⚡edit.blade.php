<?php

  use App\Models\Post;
  use App\Enums\StatusEnum;
  use Illuminate\Validation\Rule;
  use Livewire\Attributes\Layout;
  use Livewire\Component;

  new #[Layout('layouts::app', ['title' => 'Edit post'])]
  class extends Component {
    public Post $post;
    public string $title = '';
    public string $content = '';
    public string $status = 'draft';
    public array $statuses = [];

    public function mount(Post $post)
    {
      $this->post = $post;
      $this->title = $post->title;
      $this->content = $post->content;
      $this->status = $post->status->value;
      $this->statuses = StatusEnum::cases();
    }

    public function save()
    {
      $validated = $this->validate([
        'title' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
        'status' => ['required', Rule::enum(StatusEnum::class)],
      ]);

      $this->post->update($validated);

      return to_route('post.index');
    }

    public array $statusMessage = [
      'Draft' => 'Post will be saved as Draft ',
      'Published' => 'Post will published immediately',
      'Archived' => 'Post will in archived status',
    ];
  };
?>
<div>
  <flux:main class="container mx-auto">
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>
        <flux:heading size="xl">Analytics</flux:heading>
        <flux:subheading>
          Summary of visits, users, and content performance.
        </flux:subheading>
      </div>
    </div>
    <flux:heading size="xl">Edit post</flux:heading>

    <flux:breadcrumbs class="mt-4">
      <flux:breadcrumbs.item href="{{ route('post.index') }}">Posts</flux:breadcrumbs.item>
      <flux:breadcrumbs.item>Edit post</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form wire:submit.prevent="save" class="mt-8 space-y-6 max-w-3xl">
      <flux:input wire:model="title" label="Title" placeholder="Your post title"/>
      <flux:textarea wire:ref="content" wire:model="content" label="Content" placeholder="Write your post content"/>


      <flux:radio.group wire:model="status" label="Status" variant="cards" class="max-sm:flex-col gap-4 ">
        @foreach($statuses as $status)
          <flux:radio
                  :value="$status->value"
                  :label="$status->label()"
                  :description="$statusMessage[$status->label()]"
                  :icon="$status->icon()"
          />

        @endforeach

      </flux:radio.group>


      <div class="flex justify-end">
        <flux:button type="submit" variant="primary">Update post</flux:button>
      </div>
    </form>
  </flux:main>
</div>


<script>
    let textarea = this.$refs.content

    autoSizeTextarea(textarea)

    textarea.addEventListener('input', () => autoSizeTextarea(textarea))

    function autoSizeTextarea(el) {
        let style = window.getComputedStyle(el)
        let borderTop = parseFloat(style.borderTopWidth) || 0
        let borderBottom = parseFloat(style.borderBottomWidth) || 0

        el.style.height = 'auto'
        el.style.height = (el.scrollHeight + borderTop + borderBottom) + 'px'
    }
</script>
