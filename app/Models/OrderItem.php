<?php
  
  namespace App\Models;
  
  use Database\Factories\ProductCategoryFactory;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  
  class OrderItem extends Model
  {
    /** @use HasFactory<ProductCategoryFactory> */
    use HasFactory;
    
    public $guarded = [];
    
    public function order(): BelongsTo
    {
      return $this->belongsTo('order_id');
    }
  }
