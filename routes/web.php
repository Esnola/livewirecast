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
  
  Route::livewire('/post/listing', 'pages::post.listing')->name('post.listing');
  
  
  Route::livewire('/order', 'pages::order.index')->name('order.index');;
  
  
  Route::livewire('/product/', 'pages::product.index')->name('product.index');
  Route::livewire('/product/create', 'pages::product.create')->name('product.create');
  Route::livewire('/product/edit/{product}', 'pages::product.edit')->name('product.edit');
  Route::livewire('/product/delete/{product}', 'pages::product.delete')->name('product.delete');
  Route::livewire('/product/show/{product}', 'pages::product.show')->name('product.show');
  
  Route::livewire('/category', 'pages::category.show')->name('category.show');
  Route::livewire('/category/create', 'pages::category.create')->name('category.create');
  Route::livewire('/category/edit/{category}', 'pages::category.edit')->name('category.edit');
  Route::livewire('/category/delete/{category}', 'pages::category.delete')->name('category.delete');
  
  
  Route::livewire('/customer/', 'pages::customer.index')->name('customer.index');
  Route::livewire('/customer/create', 'pages::customer.create')->name('customer.create');
  Route::livewire('/customer/edit/{customer}', 'pages::customer.edit')->name('customer.edit');
  Route::livewire('/customer/{customer}', 'pages::customer.show')->name('customer.show');
