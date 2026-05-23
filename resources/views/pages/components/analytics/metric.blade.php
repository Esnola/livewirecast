<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700 ">
  <flux:subheading>{{ $heading }}</flux:subheading>
  <flux:heading size="xl" class="mb-2">{{ $number }}</flux:heading>
  {{$slot}}
</div>
