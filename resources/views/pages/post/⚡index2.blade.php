<?php

  use App\Models\Article;
  use Livewire\Attributes\Computed;
  use Livewire\Attributes\Layout;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Title;
  use Livewire\Component;

  new #[Layout('layouts::app', ['title' => 'Listing Articles'])]
  class extends Component {
    public string $title;
    public string $content = '';

    public array $articles = [];

  };

  new #[Lazy]
  class extends Component {
    public string $sort = 'newest';

    #[Computed]
    public function articles()
    {
      sleep(1);
      // $articles = Article::all();
      return Article::query()
        ->tap(fn($q) => match ($this->sort) {
          'newest' => $q->orderBy('created_at', 'desc'),
          'oldest' => $q->orderBy('created_at', 'asc'),
          default => $q->latest(),
        })
        ->get();

    }
  };

?>
<div class="flex w-full items-center justify-around mb-12">
  <flux:heading>Record</flux:heading>
  <div class="grid grid-cols-3 gap-4 pl-6 pr-20">
    @foreach($this->articles as $article)

    @endforeach
  </div>
</div>
<?php

  use Livewire\Component;
  use Livewire\Attributes\Title;
  use Livewire\Attributes\Lazy;
  use Livewire\Attributes\Computed;
  use App\Models\Post;

  new #[Lazy, Title('Posts')] class extends Component
  {
    public string $sort = 'newest';

    #[Computed]
    public function posts()
    {
      sleep(1);

      return Post::query()
        ->tap(fn ($q) => match ($this->sort) {
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
  }
