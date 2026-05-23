<?php
  
  namespace Database\Seeders;
  
  use App\Enums\ProductEnum;
  use App\Models\Product;
  use Illuminate\Database\Seeder;
  use Illuminate\Support\Facades\Http;
  
  class ProductSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Product::factory()->count(20)->create();
      //$faker = \Faker\Factory::create(); // independiente, no “pegado” a fake()
      
      $payload = Http::timeout(15)->get('https://dummyjson.com/products?limit=50')->json();
      $products = $payload['products'] ?? [];
      
      foreach ($products as $p) {
        $image = $p['thumbnail'] ?? ($p['images'][0] ?? null);
        $count = random_int(1, 3);
        $pool = [1, 2, 3, 4, 5];
        shuffle($pool);
        $categoryIds = array_slice($pool, 0, $count);
        Product::factory()->create([
          'name' => $p['title'],
          'description' => $p['description'] ?? null,
          'category_id' => array_values($categoryIds),
          'quantity' => $p['stock'] +55 ?? 15,
          'price' => fake()->numberBetween(1000, 20000),
          'image' => $image,
          'status' => fake()->randomElement(ProductEnum::cases())->value,
        ]);
      }
      
    }
  }
