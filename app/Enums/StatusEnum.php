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
        self::Draft => 'text-zinc-500! border-black/10! dark:bg-zinc-700! dark:text-zinc-400! dark:border-zinc-400!',
        self::Published => 'text-gray-500! border-black/10! dark:text-gray-200! dark:border-zinc-400!',
        self::Archived => 'text-gray-500! border-black/10! dark:bg-zinc-700! dark:text-gray-400! dark:border-zinc-400! ',
      };
    }
    
    
    public function icon(): string
    {
      return match ($this) {
        self::Draft => 'bookmark-square',
        self::Published => 'check-circle',
        self::Archived => 'archive-box',
      };
    }
  }
