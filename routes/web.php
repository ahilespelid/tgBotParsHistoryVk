<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::name('front.')->group(function(){   
Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\Home@index'])->name('home');    
Route::match(['get', 'post'], '/ppdnx5ch', ['uses' => 'App\Http\Controllers\TgBot@index'])->name('bot');    
  
});