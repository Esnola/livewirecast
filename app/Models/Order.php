<?php
  
  namespace App\Models;
  
  use Database\Factories\OrderFactory;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  
  class Order extends Model
  {
    /** @use HasFactory<OrderFactory> */
    use HasFactory;
    
    protected $guarded = [];
    
    public function user(): BelongsTo
    {
      return $this->belongsTo('customer_id');
    }
    
    public function items(): HasMany
    {
      return $this->hasMany(OrderItem::class);
    }
    
    public function products(): BelongsToMany
    {
      return $this->belongsToMany(Product::class, 'order_items')
        ->withPivot('quantity', 'price')
        ->withTimestamps();
    }
  }
