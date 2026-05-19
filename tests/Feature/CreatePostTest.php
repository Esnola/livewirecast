<?php
  
  use App\Models\Post;
  use Livewire\Livewire;
  use function Pest\Laravel\assertDatabaseHas;
  use function Pest\Laravel\assertDatabaseMissing;
  
  test('check is the post is created FROM TESTS DIRECTORY', function () {
    assertDatabaseMissing(Post::class, [
      'title' => 'My First Post',
      'content' => 'This is the content of my first post.',
    ]);


    Livewire::visit('pages::post.create')
      //->debug()
      ->type('[wire\:model="title"]', 'Test Post')
      ->type('[wire\:model="content"]', 'This is the content')
      ->press('Save')
      ->assertPathIs('/');
    
    assertDatabaseHas(Post::class, [
      'title' => 'Test Post',
      'content' => 'This is the content',
    ]);
  });
