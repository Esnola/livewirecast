<?php

  use App\Models\Order;
  use Illuminate\Pagination\LengthAwarePaginator;
  use Livewire\Attributes\Computed;
  use Livewire\Component;
  use Livewire\WithPagination;

  new class extends Component {
    use WithPagination;


    public function formatPrice($price)
    {
      return number_format($price / 100, 2, ',', '.') . ' €';
    }

    #[Computed]
    public function stats()
    {
      return [
        [
          'title' => 'Total revenue',
          'value' => '$38,393.12',
          'trend' => '16.2%',
          'trendUp' => true
        ],
        [
          'title' => 'Total transactions',
          'value' => '428',
          'trend' => '12.4%',
          'trendUp' => false
        ],
        [
          'title' => 'Total customers',
          'value' => '376',
          'trend' => '12.6%',
          'trendUp' => true
        ],
        [
          'title' => 'Average order value',
          'value' => '$87.12',
          'trend' => '13.7%',
          'trendUp' => true
        ]
      ];
    }

    #[Computed]
    public function orders()
    {
      return Order::with('items.product')->get();
    }

    #[Computed]
    public function paginator()
    {
      $total = Order::count();
      return new LengthAwarePaginator(items: range(1, $total), total: $total, perPage: 10, currentPage: 1);
    }
  };
?>

<div>
  <flux:header sticky container class="bg-white dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-600">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2"/>

    <flux:navbar class="max-lg:hidden -mb-px">
      <flux:navbar.item href="#" data-current>Dashboard</flux:navbar.item>
      <flux:navbar.item href="#" badge="{{$this->orders->count()}}">Orders</flux:navbar.item>
      <flux:navbar.item href="#">Catalog</flux:navbar.item>
      <flux:navbar.item href="#">Configuration</flux:navbar.item>
    </flux:navbar>
  </flux:header>

  <flux:sidebar collapsible="mobile"
                class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <flux:sidebar.nav>
      <flux:sidebar.item href="#" data-current>Dashboard</flux:sidebar.item>
      <flux:sidebar.item href="#" badge="32">Orders</flux:sidebar.item>
      <flux:sidebar.item href="#">Catalog</flux:sidebar.item>
      <flux:sidebar.item href="#">Configuration</flux:sidebar.item>
    </flux:sidebar.nav>
  </flux:sidebar>

  <flux:main container>
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center gap-2">
        <div class="flex items-center gap-2">
          <flux:select size="sm" class="">
            <flux:select.option>Last 7 days</flux:select.option>
            <flux:select.option>Last 14 days</flux:select.option>
            <flux:select.option selected>Last 30 days</flux:select.option>
            <flux:select.option>Last 60 days</flux:select.option>
            <flux:select.option>Last 90 days</flux:select.option>
          </flux:select>

          <flux:subheading class="max-md:hidden whitespace-nowrap">compared to</flux:subheading>

          <flux:select size="sm" class="max-md:hidden">
            <flux:select.option selected>Previous period</flux:select.option>
            <flux:select.option>Same period last year</flux:select.option>
            <flux:select.option>Last month</flux:select.option>
            <flux:select.option>Last quarter</flux:select.option>
            <flux:select.option>Last 6 months</flux:select.option>
            <flux:select.option>Last 12 months</flux:select.option>
          </flux:select>
        </div>

        <flux:separator vertical class="max-lg:hidden mx-2 my-2"/>

        <div class="max-lg:hidden flex justify-start items-center gap-2">
          <flux:subheading class="whitespace-nowrap">Filter by:</flux:subheading>

          <flux:badge as="button" rounded color="zinc" icon="plus" size="lg">Amount</flux:badge>
          <flux:badge as="button" rounded color="zinc" icon="plus" size="lg" class="max-md:hidden">Status</flux:badge>
          <flux:badge as="button" rounded color="zinc" icon="plus" size="lg">More filters...</flux:badge>
        </div>
      </div>
    </div>
    <div class="flex gap-6 mb-6">
      @foreach ($this->stats as $stat)
        <div class="relative flex-1 rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700 {{ $loop->iteration > 1 ? 'max-md:hidden' : '' }}  {{ $loop->iteration > 3 ? 'max-lg:hidden' : '' }}">
          <flux:subheading>{{ $stat['title'] }}</flux:subheading>

          <flux:heading size="xl" class="mb-2">{{ $stat['value'] }}</flux:heading>

          <div class="flex items-center gap-1 font-medium text-sm
          @if ($stat['trendUp'])
          text-green-600 dark:text-green-400
          @else
          text-red-500 dark:text-red-400
@endif">
            <flux:icon :icon="$stat['trendUp'] ? 'arrow-trending-up' : 'arrow-trending-down'"
                       variant="micro"/> {{ $stat['trend'] }}
          </div>

          <div class="absolute top-0 right-0 pr-2 pt-2">
            <flux:button icon="ellipsis-horizontal" variant="subtle" size="sm"/>
          </div>
        </div>
      @endforeach
    </div>

    <flux:table>
      <flux:table.columns>
        <flux:table.column></flux:table.column>
        <flux:table.column class="max-md:hidden">ID</flux:table.column>
        <flux:table.column class="max-md:hidden">Date</flux:table.column>
        <flux:table.column class="max-md:hidden">Status</flux:table.column>
        <flux:table.column><span class="max-md:hidden">Customer</span>
          <div class="md:hidden w-6"></div>
        </flux:table.column>
        <flux:table.column>Products</flux:table.column>
        <flux:table.column>Amount</flux:table.column>
        <flux:table.column></flux:table.column>
      </flux:table.columns>

      <flux:table.rows>
        @foreach ($this->orders as $order)
          <flux:table.row>
            <flux:table.cell class="pr-2">
              <flux:checkbox/>
            </flux:table.cell>
            <flux:table.cell class="max-md:hidden">#{{ $order->id }}</flux:table.cell>
            <flux:table.cell class="max-md:hidden">{{ $order->created_at->format('d/m/Y') }}</flux:table.cell>
            <flux:table.cell class="max-md:hidden">
              <flux:badge class="{{$order->status->badgeClass()}} border" size="sm" inset="top bottom">{{ $order->status->label() }}</flux:badge>
            </flux:table.cell>
            <flux:table.cell class="min-w-6">
              <div class="flex flex-col  gap-2">
                <flux:avatar src="{{$order->customer->avatar}}" size="xs"/>
                <span class="max-md:hidden">{{ $order->customer->name }}</span>
              </div>
            </flux:table.cell>
            <flux:table.cell class="max-w-6">
              <div class="flex flex-col items-center jusitfy-center">
                @foreach($order->items as $item)
                  <a class="font-semibold text-blue-400 text-[10px]" href="{{route('product.product',$item->product)}}">{{ $item->product->name }}</a>
                  <h6 class="mb-1 text-[10px] text-zinc-400 font-bold" >{{ $item->quantity }} x {{ $item->formatedPrice() }} = {{ $this->formatPrice( $item->quantity * $item->price) }}</h6>
                @endforeach
              </div>
            </flux:table.cell>
            <flux:table.cell class="" variant="strong">
              <flux:badge class="{{$order->status->badgeClass()}} text-[10px]!" >{{ $order->total() }} </flux:badge>
            </flux:table.cell>
            <flux:table.cell>
              <flux:dropdown position="bottom" align="end" offset="-15">
                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>

                <flux:menu>
                  <flux:menu.item icon="document-text">View invoice</flux:menu.item>
                  <flux:menu.item icon="receipt-refund">Refund</flux:menu.item>
                  <flux:menu.item icon="archive-box" variant="danger">Archive</flux:menu.item>
                </flux:menu>
              </flux:dropdown>
            </flux:table.cell>
          </flux:table.row>
        @endforeach
      </flux:table.rows>
    </flux:table>

    <flux:pagination :paginator="$this->paginator"/>
  </flux:main>
</div>
