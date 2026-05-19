<?php
  
  namespace App\Enums;
  
  enum StatusEnum: int
  {
    case Draft = 0;
    case Published = 1;
    case Archived = 2;
    
    public function label(): string
    {
      return match ($this) {
        self::Draft => __('Draft'),
        self::Published => __('Published'),
        self::Archived => __('Archived'),
      };
    }
    
    public function badgeClass(): string
    {
      return match ($this) {
        self::Draft => 'bg-zinc-100! text-gray-500! border-zinc-200',
        self::Published => 'bg-zinc-700! text-gray-200! border-zinc-200',
        self::Archived => 'bg-zinc-400 text-gray-100 border-zinc-300',
      };
    }
    
    
    public function icon(): string
    {
      return match ($this) {
        self::Draft => 'pencil',
        self::Published => 'check-circle',
        self::Archived => 'archive-box',
      };
    }
  }
