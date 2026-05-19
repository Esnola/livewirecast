<?php
  
  namespace Database\Factories;
  
  use App\Enums\StatusEnum;
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
      $createdAt = $this->faker->dateTimeBetween('-2 years', 'now');
      
      return [
        'creator' => $this->faker->name(),
        'title' => $this->faker->sentence(6),
        'content' => $this->faker->paragraphs(4, true),
        'status' => $this->faker->randomElement(StatusEnum::cases()),
        'views' => $views,
        'likes' => $likes,
        'dislikes' => $dislikes,
        'price' => $this->faker->numberBetween(10, 250),
        'created_at' => $createdAt,
        'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
      ];
    }
  }
