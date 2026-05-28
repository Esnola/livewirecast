<?php
  
  namespace App\Enums;
  
  enum ProductEnum: int
  {
    case Available = 0;
    case NotAvailable = 1;
    case Soon = 2;
    
    public function label(): string
    {
      return match ($this) {
        self::Available => __('Available'),
        self::NotAvailable => __('Not Available'),
        self::Soon => __('Coming Soon'),
      };
    }
    
    public function badgeClass(): string
    {
      $comun = " border px-2! py-1! text-xs!";
      return match ($this) {
        self::Available => 'bg-green-500/10! text-green-400! border-green-200' . $comun,
        self::NotAvailable => 'bg-red-500/10! text-red-400! border-red-200' . $comun,
        self::Soon => 'bg-yellow-500/10! text-yellow-500! border-yellow-200' . $comun,
      };
    }
    
    
    public function icon(): string
    {
      return match ($this) {
        self::Available => 'check-circle',
        self::NotAvailable => 'no-symbol',
        self::Soon => 'archive-box',
      };
    }
  }
