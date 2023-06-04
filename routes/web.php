<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::name('front.')->group(function(){   
Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\Home@index'])->name('home');    
Route::match(['get', 'post'], '/uyvf8g76vbd6dklvnrwv5giv', ['uses' => 'App\Http\Controllers\TgBot@index'])->name('bot');    
  
});