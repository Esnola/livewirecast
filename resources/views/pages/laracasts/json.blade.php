<?php

  use App\Enums\StatusEnum;
  use App\Models\Post;
  use Illuminate\Container\Attributes\Tag;
  use Illuminate\Validation\Rule;
  use Livewire\Attributes\Json;
  use Livewire\Attributes\Layout;
  use Livewire\Component;

  new #[Layout('layouts::app', ['title' => 'Tracking Dirty State - Chapter 21'])]
  class extends Component {
    public ?Post $post = null;

    public string $title = '';
    public string $content = '';
    public string $status = 'draft';

    public array $statuses = [];

    public array $statusMessage = [
      'Draft' => 'Post will be saved as Draft',
      'Published' => 'Post will published immediately',
      'Archived' => 'Post will in archived status',
    ];

    public function mount(): void
    {
      $this->post = Post::where('id', '!=', 1)->firstOrFail();

      $this->title = $this->post->title;
      $this->content = $this->post->content;
      $this->status = $this->post->status->value;
      $this->statuses = StatusEnum::cases();
    }

    public function save()
    {
      $validated = $this->validate([
        'title' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
        'status' => ['required', Rule::enum(StatusEnum::class)],
      ]);

      // $this->post->update($validated);
      //return to_route(request()->route()->getName()); More simple is : redirect()->back();
      return redirect()->back();
    }

    #[Json]
    protected function getTags($query = '')
    {
      return Tag::where('name', 'like', "%" . $query . "%")->get();
    }

  };
?>

<div>
  <flux:main class="container mx-auto">
    <div class="mb-8 flex items-center justify-between gap-4">
      <div>

        <h2 class="font-bold text-3xl mb-4">Tracking Dirty State - Chapter 21</h2>
        <flux:heading size="xl">{{$title}}</flux:heading>

        <flux:subheading>
          This post has the id number:
          <spa class="font-semibold text-3xl">{{ $post->id }}</spa>
        </flux:subheading>
      </div>
    </div>


    <form wire:submit.prevent="save" class="mt-8 max-w-3xl space-y-6">
      <flux:input
              wire:model="title"
              label="Title"
              placeholder="Your post title"
      />

      <input type="text" wire:ref="tags"/>

      <flux:textarea
              wire:ref="content"
              wire:model="content"
              wire:dirty.class="text-red-500!"
              label="Content"
              placeholder="Write your post content"
      />

      <flux:radio.group
              wire:model="status"
              label="Status"
              variant="cards"
              class="gap-4 max-sm:flex-col"
      >
        @foreach($statuses as $statusOption)
          <flux:radio
                  :value="$statusOption->value"
                  :label="$statusOption->label()"
                  :description="$statusMessage[$statusOption->label()]"
                  :icon="$statusOption->icon()"
          />
        @endforeach
      </flux:radio.group>

      <div class="flex justify-end">
        <flux:button type="submit" variant="primary">
          Update post
        </flux:button>
      </div>
    </form>
  </flux:main>
</div>

@assets
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>
@endassets


<script>
    new TomSelect(this.$refs.tags, {
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        load: (query, callback) => {
            this.getTags(query)
                .then(tags => {
                    callback(tags)
                })
                .catch(({ status, errors}) => {
                    console.log( status, errors)
                    callback()
                })
        },
    })

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
