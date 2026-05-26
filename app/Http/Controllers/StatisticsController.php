<?php
  
  namespace App\Http\Controllers;
  
  use App\Models\Post;
  
  class StatisticsController
  {
    
    public function posts(): int
    {
      $posts = Post::query()->get();
      
      return $posts->count();
    }
  }
