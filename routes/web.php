<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Telegram\TgApi;

Route::name('front.')->group(function(){   
Route::match(['get', 'post'], '/', ['uses' => 'App\Http\Controllers\Home@index'])->name('home');    
//Route::match(['get', 'post'], '/'.(new TgApi)->token->code, ['uses' => 'App\Http\Controllers\TgBot@index'])->name('bot');
Route::match(['get', 'post'], '/'.(new TgApi)->token->code, ['uses' => 'App\Telegram\TgApi@index'])->name('bot');
});