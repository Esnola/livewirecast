<?php
  
  namespace App\Models;
  
  use Database\Factories\UserFactory;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  
  class User extends Model
  {
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    
    protected $fillable = [
      'avatar',
      'name',
      'last_name',
      'phone',
      'email',
      'password',
    ];
    
    public function buys(): HasMany
    {
      return $this->hasMany(Order::class, 'customer_id');
    }
  
  }
