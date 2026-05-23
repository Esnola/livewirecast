@props([
  "isOrder" => 0,
  "item"=>null,
])


<flux:table.row>
  <flux:table.cell class="pr-2">
    <flux:checkbox/>
  </flux:table.cell>
  <flux:table.cell>#{{ $item->id }}</flux:table.cell>
  <flux:table.cell>
    <flux:badge class="{{$item->status->badgeClass()}} border" size="sm"
                inset="top bottom">{{ $item->status->label() }}</flux:badge>
  </flux:table.cell>

  @if($isOrder)
    <flux:table.cell>
      <div class="flex flex-col  gap-2">
        <flux:avatar src="{{$item->customer->avatar}}" size="xs"/>
        <a href="{{route('customer.show',$item->customer)}}">{{ $item->customer->name.' '.$item->customer->last_name }}</a>
      </div>
    </flux:table.cell>
    <flux:table.cell>{{ $item->created_at->format('d/m/Y') }} </flux:table.cell>
    <flux:table.cell class="" variant="strong">
      <flux:badge class="{{$item->status->badgeClass()}} text-[10px]!">{{ $item->total() }} </flux:badge>
    </flux:table.cell>
    <flux:table.cell class="max-w-6">
      <div class="flex flex-col items-center jusitfy-center">
        @foreach($item->items as $itemItem)
          <a class="font-semibold text-blue-400 text-[10px]"
             href="{{route('product.show',$itemItem->product)}}">{{ $itemItem->product->name }}</a>
          <h6 class="mb-1 text-[10px] text-zinc-400 font-bold">{{ $itemItem->quantity }}
            x {{ $this->formatNumber( $itemItem->price) }} = {{ $this->formatNumber( $itemItem->quantity * $itemItem->price, 0) }}</h6>
        @endforeach
      </div>
    </flux:table.cell>
  @else
    <flux:table.cell>
      <flux:avatar src="{{$item->image}}" size="lg"/>
      <a href="{{route('product.show', $item->id)}}">{{ $item->name }}</a>
    </flux:table.cell>
    <flux:table.cell class="text-xs">{{ $item->quantity }}</flux:table.cell>
    <flux:table.cell class="max-w-6 text-xs">{{ $item->getFormattedPrice() }}</flux:table.cell>
    <flux:table.cell class="max-w-6 text-xs">{{$item->quantity * $item->price / 100}}</flux:table.cell>
    <flux:table.cell class=" ">
      <ul>
        @foreach ($item->categories() as $category)
          <li>
            <a href="{{route('category.show', $category->id)}}"
               class="font-semibold text-blue-400 text-[10px]"> {{ $category->name }}</a>
          </li>
        @endforeach
      </ul>
    </flux:table.cell>
  @endif

  <x-partials.table-actions :isOrder="$isOrder" />
</flux:table.row>
