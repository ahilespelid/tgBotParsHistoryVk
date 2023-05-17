<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use 
    App\Models\StoryVk;


class HomeController extends Controller{    
public function index(){
///*/ Вкладка Суды-первой инстанции ///*/        
return view('front.undefine',['deal' => []]);}

}