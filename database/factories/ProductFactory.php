<?php
  
  namespace Database\Factories;
  
  use App\Enums\ProductEnum;
  use App\Models\Product;
  use App\Models\ProductCategory;
  use Illuminate\Database\Eloquent\Factories\Factory;
  
  /**
   * @extends Factory<Product>
   */
  class ProductFactory extends Factory
  {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
        'name' => fake()->words(3, true),
        'description' => fake()->paragraph(),
        'product_category_id' => ProductCategory::factory(),
        'image' => fake()->imageUrl(),
        'quantity' => fake()->numberBetween(1, 25),
        'price' => fake()->numberBetween(10, 500), // e.g., in cents
        'status' => $this->faker->randomElement(ProductEnum::cases()),
      ];
    }
  }
