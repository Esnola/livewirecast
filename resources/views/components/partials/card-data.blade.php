<flux:table.row>
  <flux:table.cell class="pr-2">
    <flux:checkbox/>
  </flux:table.cell>
  <flux:table.cell>#{{ $item->id }}</flux:table.cell>
  <flux:table.cell>
    <flux:badge class="{{$item->status->badgeClass()}} border" size="sm" inset="top bottom">{{ $item->status->label() }}</flux:badge>
  </flux:table.cell>
  <flux:table.cell class="min-w-6">
    <div class="flex flex-col  gap-2">
      <flux:avatar src="{{$item->customer->avatar}}" size="xs"/>
      <a href="{{route('customer.show',$item->customer)}}">{{ $item->customer->name.' '.$item->customer->last_name }}</a>
    </div>
  </flux:table.cell>
  <flux:table.cell>{{ $item->created_at->format('d/m/Y') }}</flux:table.cell>
  <flux:table.cell class="max-w-6">
    <div class="flex flex-col items-center jusitfy-center">
      @foreach($item->items as $itemItem)
        <a class="font-semibold text-blue-400 text-[10px]" href="{{route('product.show',$itemItem->product)}}">{{ $itemItem->product->name }}</a>
        <h6 class="mb-1 text-[10px] text-zinc-400 font-bold" >{{ $itemItem->quantity }} x {{ $itemItem->formatedPrice() }} = {{ $this->formatPrice( $itemItem->quantity * $itemItem->price) }}</h6>
      @endforeach
    </div>
  </flux:table.cell>
  <flux:table.cell class="" variant="strong">
    <flux:badge class="{{$item->status->badgeClass()}} text-[10px]!" >{{ $item->total() }} </flux:badge>
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
