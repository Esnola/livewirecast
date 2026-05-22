<?php

  use Livewire\Component;
  use App\Models\Product;
  use App\Models\ProductCategory;

  new class extends Component
  {
    public Product $product;

    public array $categoryMap = [];

    public function mount(Product $product)
    {
      $this->product = $product;

      $this->categoryMap = ProductCategory::pluck('name', 'id')->toArray();
    }
  };
?>

<div class="flex flex-col items-center justify-center gap-4 max-w-1/4 mx-auto border mt-4 p-6">
  <h1>{{ $product->name }}</h1>
  <img src={{ "$product->image"}} />
  <p>{{ $product->description }}</p>
  <p>{{ $product->getFormattedPrice() }}</p>
  <p>Quantity: {{ $product->quantity }}</p>
  <flux:badge class="{{$product->status->badgeClass() }}"> {{ $product->status->label() }}</flux:badge>


  <div>
    <ul>
    @foreach ($product->category_id ?? [] as $catId)
      <li>
                {{ $categoryMap[$catId] ?? "Cat {$catId}" }}
            </li>
    @endforeach
    </ul>
  </div>
</div>
