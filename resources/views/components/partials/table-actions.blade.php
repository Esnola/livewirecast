@props([
  "isOrder" => 0,
  "item"=>null,
])
@php
  switch (true) {
    case ($isOrder):
      $actions = [
        ['icon' => 'document-text', 'label' => 'View invoice'],
        ['icon' => 'receipt-refund', 'label' => 'Refund'],
        ['icon' => 'archive-box', 'label' => 'Archive', 'variant' => 'danger']
        ];
      break;

    default:
      $actions = [
        ['icon' => 'eye', 'label' => 'View details'],
        ['icon' => 'pencil-square', 'label' => 'Edit item'],
        ['icon' => 'trash', 'label' => 'Delete item', 'variant' => 'danger']
      ];
  }

 @endphp


<flux:table.cell>
  <flux:dropdown position="bottom" align="end" offset="-15">
    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
    <flux:menu>
      <flux:menu.item icon="{{ $actions[0]['icon'] }}">{{ $actions[0]['label'] }}</flux:menu.item>
      <flux:menu.item icon="{{ $actions[1]['icon'] }}">{{ $actions[1]['label'] }}</flux:menu.item>
      <flux:menu.item icon="{{ $actions[2]['icon'] }}" variant="danger">{{ $actions[2]['label'] }}</flux:menu.item>
    </flux:menu>
  </flux:dropdown>
</flux:table.cell>
