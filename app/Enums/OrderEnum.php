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
      $comun = ' border px-2! py-1! text-xs! transition-colors duration-300';
      return match ($this) {
        self::Paid => 'bg-green-100/30! text-green-400! border-green-300! hover:text-green-600! hover:bg-green-200/80!'. $comun,
        self::Incomplete => 'bg-olive-100/30! text-olive-400! border-olive-300! hover:text-green-600! hover:bg-olive-200/80!' . $comun,
        self::Refunded => 'bg-sky-100/30! text-sky-400! border-sky-300! hover:text-sky-600! hover:bg-sky-200/80!' . $comun,
        self::Failed => 'bg-red-100/30! text-red-400! border-red-300! hover:text-red-600! hover:bg-red-200/80!'. $comun,
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
