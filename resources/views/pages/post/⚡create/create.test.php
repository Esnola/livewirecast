<?php

use Livewire\Livewire;
  use App\Models\Post;
  use function Pest\Laravel\assertDatabaseHas;
  use function Pest\Laravel\assertDatabaseMissing;
  

it('renders successfully FROM LIVEWIRE DIRECTORY', function () {
    Livewire::test('pages::post.create')
        ->assertStatus(200);
});
  
  
  test('check is the post is created from page directory', function () {
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
