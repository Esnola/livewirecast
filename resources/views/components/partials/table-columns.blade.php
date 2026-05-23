@props([
    'isOrder' => 0
])

<flux:table.columns>
  <flux:table.column></flux:table.column>
  <flux:table.column>ID</flux:table.column>
  <flux:table.column>Status</flux:table.column>
  <flux:table.column>{{$isOrder ? 'Customer':'Product'}}</flux:table.column>
  <flux:table.column>{{$isOrder ? 'Date':'Quantity'}}</flux:table.column>
  <flux:table.column>{{$isOrder ? 'Amount':'Price'}}</flux:table.column>
  <flux:table.column>{{$isOrder ? 'Products':'Investment'}}</flux:table.column>
  @if(!$isOrder)
    <flux:table.column>Categories</flux:table.column>
  @endif
  <flux:table.column>Actions</flux:table.column>
</flux:table.columns>
