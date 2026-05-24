<?php
  
  namespace App\Livewire\Concerns;
  
  use App\Models\Post;
  use Carbon\CarbonImmutable;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Support\Collection;
  
  readonly class Analytics
  {
    public function __construct(
      private string $period = 'month'
    )
    {
    }
    
    public static function period(string $period): self
    {
      return new self($period);
    }
    
    public function topPosts(): Collection
    {
      return $this->query()
        ->select(['id', 'title', 'creator', 'views', 'likes'])
        ->orderByDesc('views')
        ->limit(5)
        ->get();
    }
    
    private function query(): Builder
    {
      return Post::query()
        ->where('created_at', '>=', $this->startDate());
    }
    
    private function startDate(): CarbonImmutable
    {
      $now = CarbonImmutable::now();
      
      return match ($this->period) {
        'day' => $now->startOfDay(),
        'week' => $now->startOfWeek(),
        'year' => $now->startOfYear(),
        default => $now->startOfMonth(),
      };
    }
    
    public function topCountries(): Collection
    {
      $views = max(1, $this->views());
      
      return collect([
        [
          'country' => 'España',
          'views' => (int)round($views * 0.42),
        ],
        [
          'country' => 'México',
          'views' => (int)round($views * 0.21),
        ],
        [
          'country' => 'Argentina',
          'views' => (int)round($views * 0.15),
        ],
        [
          'country' => 'Colombia',
          'views' => (int)round($views * 0.12),
        ],
        [
          'country' => 'Chile',
          'views' => (int)round($views * 0.10),
        ],
      ]);
    }
    
    /*
     This function is for data changes while developing, it will return a random number between 100
     and 1000 in local environment while we are studying.
     */
    public function randomize()
    {
      if(config('app.env') === 'local') {
        return rand(100, 1000);
      }
      return 0;
    }
    
    
    
    public function views(): int
    {
      return (int)$this->query()->sum('views') + $this->randomize();
    }
    
    public function avgTime(): string
    {
      
      $seconds = (int)$this->query()->avg('average') + $this->randomize()*10;
      if ($seconds === 0) {
        return '0m 00s';
      }
      
      if ($seconds <= 0) {
        return '00m 00s';
      }
      
      $hours = intdiv($seconds, 3600);
      $minutes = intdiv($seconds % 3600, 60);
      $secs = $seconds % 60;
      
      
      return $hours > 0 ? sprintf('%dh %02dm %02ds', $hours, $minutes, $secs) : sprintf('%02dm %02ds', $minutes, $secs);
      
    }
    
    public function visitors(): int
    {
      return (int)round($this->query()->sum('visitors')) + $this->randomize();
    }
  }
