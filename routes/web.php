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

Route::livewire('/article/index','pages::article.index')->name('article.index');
