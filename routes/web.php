<?php
  
  use Illuminate\Support\Facades\Route;
  
  /*
  Route::get('/', function () {
      return view('layouts.app',
        ['title' => 'Home',
          'slot' => '<flux:avatar src="https://unavatar.io/x/calebporzio" />']);
  });*/
  
  Route::livewire('/', 'pages::home')->name('home');
  Route::livewire('/post/create', 'pages::post.create')->name('post.create');
  
  Route::livewire('/post/index', 'pages::post.index')->name('post.index');
  Route::livewire('/product/products', 'pages::product.products')->name('product.products');
  Route::livewire('/sale/orders', 'pages::sale.orders')->name('sale.orders');;
  Route::livewire('/post/listing', 'pages::post.listing')->name('post.listing');
  Route::livewire('/product/product/{product}', 'pages::product.product')->name('product.product');
