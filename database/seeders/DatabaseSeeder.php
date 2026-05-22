<?php
  
  namespace Database\Seeders;
  
  
  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
  use Illuminate\Database\Seeder;
  
  class DatabaseSeeder extends Seeder
  {
    use WithoutModelEvents;
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      // User::factory(10)->create();
      
      /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
      $this->call(UserSeeder::class);
      $this->call(ArticleSeeder::class);
      $this->call(PostSeeder::class);
      $this->call(ProductCategorySeeder::class);
      $this->call(OrderSeeder::class);
      $this->call(ProductSeeder::class);
      $this->call(OrderItemSeeder::class);
    }
    
  }
