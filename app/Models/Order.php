<?php
  
  namespace App\Models;
  
  use App\Enums\OrderEnum;
  use App\Enums\StatusEnum;
  use Database\Factories\OrderFactory;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  use Illuminate\Support\Collection;
  
  class Order extends Model
  {
    /** @use HasFactory<OrderFactory> */
    use HasFactory;
    
    protected $guarded = [];
    
    public $casts =[
      'status' => OrderEnum::class,
    ];
    
    public function customer(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
    
    public function product(): BelongsTo
    {
      return $this->belongsTo(Product::class);
    }
    
    public function items(): HasMany
    {
      return $this->hasMany(OrderItem::class);
    }
    
    public function total(): string
    {
      $quantity = $this->items->sum(fn(OrderItem $item) => $item->price * $item->quantity);
      
      return number_format($quantity / 100, 2, ',', '.') . ' €';
    }
    
    

    
    public function productsSummary(): Collection
    {
      return $this->items->map(fn(OrderItem $item) => [
        'product' => $item->product->name,
        'price' => $item->price,
        'quantity' => $item->quantity,
        'subtotal' => $item->price * $item->quantity,
      ]);
    }
  }
