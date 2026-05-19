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
  };
