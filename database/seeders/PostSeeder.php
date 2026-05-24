<?php
  
  namespace Database\Seeders;
  
  
  use App\Models\Post;
  use Carbon\CarbonImmutable;
  use Illuminate\Database\Seeder;
  
  class PostSeeder extends Seeder
  {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
      $now = CarbonImmutable::now();
      
      Post::factory()
        ->count(10)
        ->create([
          'created_at' => $now,
          'updated_at' => $now,
        ]);
      
      Post::factory()
        ->count(15)
        ->create([
          'created_at' => $now->subDays(2),
          'updated_at' => $now->subDays(2),
        ]);
      
      Post::factory()
        ->count(20)
        ->create([
          'created_at' => $now->subWeeks(2),
          'updated_at' => $now->subWeeks(2),
        ]);
      
      Post::factory()
        ->count(25)
        ->create([
          'created_at' => $now->subMonths(3),
          'updated_at' => $now->subMonths(3),
        ]);
    }
  }
