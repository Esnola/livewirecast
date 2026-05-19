<?php
  
  namespace Database\Factories;
  
  use App\Enums\ArticleStatusEnum;
  use App\Models\Article;
  use Illuminate\Database\Eloquent\Factories\Factory;
  
  class ArticleFactory extends Factory
  {
    protected $model = Article::class;
    
    public function definition(): array
    {
      $views = $this->faker->numberBetween(0, 10000);
      $likes = $this->faker->numberBetween(0, $views);
      $dislikes = $this->faker->numberBetween(0, max(0, $views - $likes));
      
      return [
        'creator' => $this->faker->name(),
        'title' => $this->faker->sentence(6),
        'content' => $this->faker->paragraphs(4, true),
        'status' => $this->faker->randomElement(ArticleStatusEnum::cases()),
        'views' => $views,
        'likes' => $likes,
        'dislikes' => $dislikes,
        'price' => $this->faker->numberBetween(10, 250),
      ];
    }
  }
