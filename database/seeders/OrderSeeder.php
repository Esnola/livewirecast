<?php
  
  namespace Database\Seeders;
  
  use App\Models\Order;
  use App\Models\OrderItem;
  use Illuminate\Database\Seeder;
  
  class OrderSeeder extends Seeder
  {
    public function run(): void
    {
      
      Order::factory()->count(100)->create()->each(function (Order $order) {
          $count = fake()->numberBetween(1, 3);
          
          OrderItem::factory()->count($count)->create([
            'order_id' => $order->id,
          ]);
        });
    }
  }
