<?php
  
  namespace App\Enums;
  
  enum OrderEnum: int
  {
    case Paid = 0;
    case Incomplete = 1;
    case Refunded = 2;
    case Failed = 3;
    
    public function label(): string
    {
      return match ($this) {
        self::Paid => __('Paid'),
        self::Incomplete => __('Incomplete'),
        self::Refunded => __('Refunded'),
        self::Failed => __('Failed'),
      };
    }
    
    public function badgeClass(): string
    {
      return match ($this) {
        self::Paid => 'bg-zinc-100! text-gray-500! border-zinc-200',
        self::Incomplete => 'bg-zinc-700! text-gray-200! border-zinc-200',
        self::Refunded => 'bg-zinc-400 text-gray-100 border-zinc-300',
        self::Failed => 'bg-red-400 text-gray-100 border-red-300',
      };
    }
    
    
    public function icon(): string
    {
      return match ($this) {
        self::Paid => 'pencil',
        self::Incomplete => 'check-circle',
        self::Refunded => 'archive-box',
        self::Failed => 'x-circle',
      };
    }
  }
