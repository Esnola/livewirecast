<?php
  
  namespace Database\Factories;
  
  use App\Enums\OrderEnum;
  use App\Models\Order;
  use App\Models\User;
  use Illuminate\Database\Eloquent\Factories\Factory;
  
  /**
   * @extends Factory<Order>
   */
  class OrderFactory extends Factory
  {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $createdAt = $this->faker->dateTimeBetween('-2 years', 'now');
      $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');
      $users = User::query()->pluck('id');
      return [
        'customer_id' =>  fn () => $users->random(),
        'status' => fake()->randomElement(OrderEnum::cases())->value,
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
      ];
    }
  }
