<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use 
    App\Models\StoryVk;


class Home extends Controller{    
public function index(){
///*/ Вкладка Суды-первой инстанции ///*/
pa((new TgBot())->vk_get('users')); exit;       
return view('front.undefine',['deal' => []]);}

}