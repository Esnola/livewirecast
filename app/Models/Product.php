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
      'price' => 'integer',
    ];
    
    public function getFormattedPrice(): string
    {
      return number_format($this->precio / 100, 2, ',', '.') . ' €';
    }
    
    public function order(): HasMany
    {
      return $this->hasMany('Order');
    }
    
    public function category(): HasMany
    {
      $this->hasMany('ProductCategory');
    }
  }
