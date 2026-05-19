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
