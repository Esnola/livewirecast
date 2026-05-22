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
      return match ($this) {
        self::Available => 'bg-zinc-100! text-gray-500! border-zinc-200',
        self::NotAvailable => 'bg-zinc-700! text-gray-200! border-zinc-200',
        self::Soon => 'bg-zinc-400 text-gray-100 border-zinc-300',
      };
    }
    
    
    public function icon(): string
    {
      return match ($this) {
        self::Available => 'pencil',
        self::NotAvailable => 'check-circle',
        self::Soon => 'archive-box',
      };
    }
  }
