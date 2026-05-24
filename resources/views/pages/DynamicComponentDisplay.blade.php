<?php

  use Livewire\Component;

  new class extends Component {
    public string $heading;

    public int|float|string $number;

    public int|float|null $change = null;
  };
?>

<div class="relative flex-1 rounded-lg bg-zinc-50 px-6 py-4 dark:bg-zinc-700">
  <div class="flex items-start justify-between gap-4">
    <div>
      <flux:subheading>{{ $heading }}</flux:subheading>

      <flux:heading size="xl" class="mb-2">
        {{ is_numeric($number) ? number_format( $number, 0, ',', '.') : $number }}
      </flux:heading>
    </div>

    @if ($change !== null)
      <span
                @class([
                    'rounded-full px-2 py-1 text-xs font-medium',
                    'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-300' => $change >= 0,
                    'bg-red-100 text-red-700 dark:bg-red-400/10 dark:text-red-300' => $change < 0,
                ])
            >
                {{ $change > 0 ? '+' : '' }}{{ $change }}%
            </span>
    @endif
  </div>

  {{ $slot }}
</div>
