
<flux:table.cell>
  <flux:dropdown position="bottom" align="end" offset="-15">
    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom" />
    <flux:menu>
      @foreach ($this->actions() as $action)
        <flux:menu.item icon="{{ $action['icon'] }}" :variant="$action['variant'] ?? null" >
          {{ $action['label'] }}
        </flux:menu.item>
      @endforeach
    </flux:menu>
  </flux:dropdown>
</flux:table.cell>
