
<flux:table.columns>
  <flux:table.column/>
  @foreach ($this->tableHeaders() as $column)
    <flux:table.column>{{ $column }}</flux:table.column>
  @endforeach
</flux:table.columns>
