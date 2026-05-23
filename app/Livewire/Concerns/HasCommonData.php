<?php
  
  namespace App\Livewire\Concerns;
  
  use App\Models\Order;
  use App\Models\Product;
  use Illuminate\Pagination\LengthAwarePaginator;
  use Livewire\Attributes\Computed;
  
  trait HasCommonData
  {
    
    public function formatNumber(float $number, int $divisor = 100): string
    {
      return $divisor > 1
        ? number_format($number / $divisor, 2, ',', '.') . '€'
        : number_format($number, 0, ',', '.');
    }
    
    #[Computed]
    public function products()
    {
      return  Product::get() ;
    }
    
    #[Computed]
    public function orders()
    {
       return  Order::with('items.product')->get();
    }
    
    
    #[Computed]
    public function counters(): array
    {
       return [
        'orders' =>  Order::count(),
        'products' => Product::count(),
      ];
      
    }
    
    #[Computed]
    public function isProductPage(): bool
    {
      return str_contains(request()->route()->getName() ?? '', 'product');
    }
    
    #[Computed]
    public function paginator()
    {
      $total = $this->isProductPage ? Product::count() : Order::count();
      return new LengthAwarePaginator(items: range(1, $total), total: $total, perPage: 10, currentPage: 1);
    }
    
    #[Computed]
    public function stats(): array
    {
      return $this->isProductPage
        ? $this->productStats()
        : $this->orderStats();
    }
    
    private function productStats(): array
    {
      return [
        [
          'title'   => 'Total Quantity',
          'value'   => $this->formatNumber(Product::sum('quantity'), 0),
          'trend'   => '16.2%',
          'trendUp' => true
        ],
        [
          'title'   => 'Total products',
          'value'   => $this->formatNumber(Product::count(), 0),
          'trend'   => '12.4%',
          'trendUp' => false
        ],
        [
          'title'   => 'Total Investment',
          'value'   => $this->formatNumber(Product::selectRaw('SUM(price * quantity) as total')->value('total')),
          'trend'   => '12.6%',
          'trendUp' => true
        ],
      ];
    }
    
    private function orderStats(): array
    {
      $totalRevenue = $this->orders->sum(fn(Order $order) => $order->amountOrder());
      $orderCount   = $this->orders->count();
      
      return [
        [
          'title'   => 'Total revenue',
          'value'   => $this->formatNumber($totalRevenue),
          'trend'   => '16.2%',
          'trendUp' => true
        ],
        [
          'title'   => 'Total products',
          'value'   => $this->formatNumber($this->orders->sum(fn(Order $order) => $order->items->sum('quantity'))),
          'trend'   => '12.4%',
          'trendUp' => false
        ],
        [
          'title'   => 'Total customers',
          'value'   => $this->orders->pluck('customer_id')->unique()->count(),
          'trend'   => '12.6%',
          'trendUp' => true
        ],
        [
          'title'   => 'Average order value',
          'value'   => $this->formatNumber($orderCount > 0 ? $totalRevenue / $orderCount : 0),
          'trend'   => '13.7%',
          'trendUp' => true
        ],
      ];
    }
  }
