<?php
  
  namespace Database\Factories;
  
  use App\Models\Order;
  use App\Models\OrderItem;
  use App\Models\Product;
  use Illuminate\Database\Eloquent\Factories\Factory;
  
  class OrderItemFactory extends Factory
  {
    protected $model = OrderItem::class;
    
    public function definition(): array
    {
      return [
        'order_id' => Order::factory(),
        'product_id' => null,
        'quantity' => fake()->numberBetween(1, 10),
        'price' => null,
      ];
    }
    
    public function configure(): static
    {
      return $this->afterMaking(function (OrderItem $orderItem) {
        $product = Product::query()->inRandomOrder()->first() ?? Product::factory()->create();
        $orderItem->product_id = $product->id;
        $orderItem->price = $product->price;
      });
    }
  }
