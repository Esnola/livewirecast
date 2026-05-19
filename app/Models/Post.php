<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /** @use HasFactory<\Database\Factories\PostFactory> */
  use HasFactory;
  
  protected $guarded = [];
  
  
  protected $casts = [
    'status' => StatusEnum::class,
    'price' => 'integer',
  ];
  
  protected function price(): Attribute
  {
    return Attribute::make(
      get: fn($value) => $value / 100,
      set: fn($value) => (int)round($value * 100)
    );
  }
  
  public function formattedPrice(): string
  {
    return number_format($this->getRawOriginal('price') / 100, 2, ',', '.');
  }
}
