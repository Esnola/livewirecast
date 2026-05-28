<?php
  
  use App\Http\Controllers\StatisticsController;
  use Illuminate\Support\Facades\Route;
  
  Route::livewire('/', 'pages::home')->name('home');
  Route::livewire('/analytics', 'pages::analytics.index')->name('analytics.index');
  
  
  Route::livewire('/laracasts', 'pages::laracasts.index')->name('laracasts.index');
  Route::livewire('/laracasts/sort', 'pages::laracasts.sort')->name('laracasts.sort');
  Route::livewire('/laracasts/cards', 'pages::laracasts.cards')->name('laracasts.cards');
  Route::livewire('/laracasts/elements-refs', 'pages::laracasts.elements-refs')->name('laracasts.elements-refs');
  Route::livewire('/laracasts/tracking', 'pages::laracasts.tracking-dirty-state')->name('laracasts.tracking');
  Route::livewire('/laracasts/json', 'pages::laracasts.json')->name('laracasts.json');
  Route::livewire('/laracasts/interceptors', 'pages::laracasts.interceptors')->name('laracasts.interceptors');
  Route::livewire('/laracasts/cards-version', 'pages::laracasts.cards-version')->name('laracasts.cards-version');
  
  
  Route::livewire('/post/create', 'pages::post.create')->name('post.create');
  Route::livewire('/post/index', 'pages::post.index')->name('post.index');
  Route::livewire('/post/listing', 'pages::post.listing')->name('post.listing');
  Route::livewire('/post/edit/{post}', 'pages::post.edit')->name('post.edit');
  Route::livewire('/post/edit/{post}', 'pages::post.edit')->name('post.edit');
  
  
  Route::livewire('/orders', 'pages::order.index')->name('order.index');
  Route::livewire('/order/create', 'pages::order.create')->name('order.create');
  Route::livewire('/order/show/{order}', 'pages::order.show')->name('order.show');
  Route::livewire('/order/edit/{order}', 'pages::order.edit')->name('order.edit');
  Route::livewire('/order/delete/{order}', 'pages::order.delete')->name('order.delete');
  
  
  Route::livewire('/products/', 'pages::product.index')->name('product.index');
  Route::livewire('/product/create', 'pages::product.create')->name('product.create');
  Route::livewire('/product/img_upload', 'pages::product.img_upload')->name('product.img_upload');
  Route::livewire('/product/show/{product}', 'pages::product.show')->name('product.show');
  Route::livewire('/product/edit/{product}', 'pages::product.edit')->name('product.edit');
  Route::livewire('/product/delete/{product}', 'pages::product.delete')->name('product.delete');
  
  
  Route::livewire('/categories', 'pages::category.index')->name('category.index');
  Route::livewire('/category/create', 'pages::category.create')->name('category.create');
  Route::livewire('/category/show/{category}', 'pages::category.show')->name('category.show');
  Route::livewire('/category/edit/{category}', 'pages::category.edit')->name('category.edit');
  Route::livewire('/category/delete/{category}', 'pages::category.delete')->name('category.delete');
  
  
  Route::livewire('/customers', 'pages::customer.index')->name('customer.index');
  Route::livewire('/customer/create', 'pages::customer.create')->name('customer.create');
  Route::livewire('/customer/{customer}', 'pages::customer.show')->name('customer.show');
  Route::livewire('/customer/edit/{customer}', 'pages::customer.edit')->name('customer.edit');
  Route::livewire('/customer/delete/{customer}', 'pages::customer.delete')->name('customer.delete');
  
  
  Route::get('/numbers/post', [StatisticsController::class, 'posts'])->name('numerposts');
