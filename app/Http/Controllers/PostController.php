<?php
  
  namespace App\Http\Controllers;
  
  use App\Models\Post;
  
  class PostController
  {
    
    public function posts()
    {
      $totalPosts = Post::count();
    }
    
  }
