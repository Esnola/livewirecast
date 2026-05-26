<?php
  
  namespace App\Providers;
  
  use App\Models\Article;
  use App\Models\Order;
  use App\Models\Post;
  use App\Models\Product;
  use Illuminate\Support\Facades\Blade;
  use Illuminate\Support\Facades\Cache;
  use Illuminate\Support\Facades\View;
  use Illuminate\Support\ServiceProvider;
  
  class AppServiceProvider extends ServiceProvider
  {
    public function boot(): void
    {
      Blade::anonymousComponentNamespace('pages/components', 'pages');
      
      View::composer('*', function ($view) {
        $view->with([  // ✅ Usa ->with() o ->share() correctamente
          'totalPosts' => Cache::remember('posts_count', now()->addMinutes(15), fn() => Post::count()),
          'ordersCount' => Cache::remember('orders_count', now()->addMinutes(15), fn() => Order::count()),
          'productsCount' => Cache::remember('products_count', now()->addMinutes(15), fn() => Product::count()),
          'articlesCount' => Cache::remember('articles_count', now()->addMinutes(15), fn() => Article::count()),
        ]);
      });
    }
  }
