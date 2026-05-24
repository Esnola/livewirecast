<?php
  
  namespace App\Livewire\Concerns;

use App\Models\Post;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class Analytics
{
    public function __construct(
        private readonly string $period = 'month'
    ) {}

    public static function period(string $period): self
    {
        return new self($period);
    }

    public function views(): int
    {
        return (int) $this->query()->sum('views');
    }

    public function visitors(): int
    {
        /*
          Como actualmente la tabla posts no tiene una columna de visitantes,
          calculamos una estimación simple basada en las vistas.
         */
        return (int) round($this->views() * 0.62);
    }

    public function avgTime(): string
    {
        /*
          Como actualmente no existe una columna de tiempo medio,
          devolvemos una estimación estable basada en actividad.
         */
        $average =(int) $this->query()->sum('average');
   

        if ($average === 0) {
            return '0m 00s';
        }

        $seconds = min(420, max(45, (int) round($average / 8)));

        return sprintf('%dm %02ds', intdiv($seconds, 60), $seconds % 60);
    }

    public function topPosts(): Collection
    {
        return $this->query()
            ->select(['id', 'title', 'creator', 'views', 'likes'])
            ->orderByDesc('views')
            ->limit(5)
            ->get();
    }

    public function topCountries(): Collection
    {
        /*
          Como todavía no hay tabla/columna de países,
          devolvemos datos simulados proporcionales a las visitas reales.
         */
        $views = max(1, $this->views());

        return collect([
            [
                'country' => 'España',
                'views' => (int) round($views * 0.42),
            ],
            [
                'country' => 'México',
                'views' => (int) round($views * 0.21),
            ],
            [
                'country' => 'Argentina',
                'views' => (int) round($views * 0.15),
            ],
            [
                'country' => 'Colombia',
                'views' => (int) round($views * 0.12),
            ],
            [
                'country' => 'Chile',
                'views' => (int) round($views * 0.10),
            ],
        ]);
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
}
