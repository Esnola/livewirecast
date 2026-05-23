<?php
  use App\Livewire\Concerns\HasCommonData;
  use Livewire\Component;

  new class extends Component {  use HasCommonData; }
?>


<div>
<x-partials.headers-section />

  <flux:main container>

  <x-partials.filters-section />

  <x-partials.stats />

    <flux:table>

      <x-partials.table-columns/>

      <flux:table.rows>

        @foreach ($this->products as $item)

          <x-partials.card-data :item="$item"/>

        @endforeach

      </flux:table.rows>

    </flux:table>

    <flux:pagination :paginator="$this->paginator"/>

  </flux:main>

</div>
