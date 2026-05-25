<?php

  use App\Livewire\Concerns\HasCommonData;
  use Livewire\Component;
  use Livewire\Attributes\Title;

  new #[Title('Product inventory')]
  class extends Component {
    use HasCommonData;

    public string $title = 'Product inventory';
  }
?>


<div class="relative">
  <x-partials.headers-section :title="$title"/>


  <flux:main container>

    <x-partials.filters-section/>

    <x-partials.stats/>

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
