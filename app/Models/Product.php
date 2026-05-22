<?php
  
  namespace App\Models;
  
  use App\Enums\ProductEnum;
  use Database\Factories\ProductFactory;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  
  class Product extends Model
  {
    /** @use HasFactory<ProductFactory> */
    use HasFactory;
    
    public $guarded = [];
    
    public $casts = [
      'status' => ProductEnum::class,
      'category_id' => 'array',
      'price' => 'integer',
    ];
    
    public function getFormattedPrice(): string
    {
      return number_format($this->price / 100, 2, ',', '.') . ' €';
    }
    
    public function order(): HasMany
    {
      return $this->hasMany(Order::class);
    }
    
    
    public function categories()
    {
      return ProductCategory::whereIn('id', $this->category_id ?? [])->get();
    }
    
  }
