<?php
  
  namespace Database\Factories;
  
  use App\Enums\StatusEnum;
  use App\Models\Post;
  use Illuminate\Database\Eloquent\Factories\Factory;
  
  /**
   * @extends Factory<Post>
   */
  class PostFactory extends Factory
  {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $views = $this->faker->numberBetween(0, 100000);
      $likes = $this->faker->numberBetween(0, $views);
      $dislikes = $this->faker->numberBetween(0, max(0, $views - $likes));
      $visitors = $this->faker->numberBetween($dislikes, $likes + $dislikes);
      //   $createdAt = $this->faker->dateTimeBetween('-1 years', 'now');
      
      return [
        'creator' => $this->faker->name(),
        'title' => $this->faker->sentence(6),
        'content' => $this->faker->paragraphs(4, true),
        'status' => $this->faker->randomElement(StatusEnum::cases()),
        'views' => $views,
        'visitors' => $visitors,
        'likes' => $likes,
        'dislikes' => $dislikes,
        'average' => $this->faker->numberBetween(100, 2500),
        //   'created_at' => $createdAt,
        // 'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now'),
      ];
    }
    
  }
