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
    
    public function amountOrder()
    {
      return $this->items->sum(fn(OrderItem $item) => $item->price * $item->quantity);
    }
    
    public function total(): string
    {
      return number_format($this->amountOrder() / 100, 2, ',', '.') . ' €';
    }
    
  }
