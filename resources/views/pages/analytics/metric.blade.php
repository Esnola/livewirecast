<div class="relative flex-1 rounded-lg bg-zinc-50 px-6 py-4 dark:bg-zinc-700">
  <div class="flex items-start justify-between gap-2">
    <div class="mb-6">
      <flux:subheading>{{ $heading }}</flux:subheading>

      <flux:heading size="xl" class="ml-6">

        {{ is_numeric($number) ? number_format((float) $number, 0, ',', '.') : $number }}
      </flux:heading>
    </div>

    {{ $slot }}
  </div>
  @if ($change !== null)
    <span {{ $attributes->class([
                    'rounded-full! px-2 py-1 text-xs font-medium mt-12! border',
                    'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/10 dark:text-emerald-300' => $change >= 0,
                    'bg-red-100 text-red-700 dark:bg-red-400/10 dark:text-red-300' => $change < 0,
                ])}}
    >
      {{ $change > 0 ? '+' : '' }}{{ $change }}%
    </span>
  @endif
</div>
