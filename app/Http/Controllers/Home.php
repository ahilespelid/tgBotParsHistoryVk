<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Telegram\TgApi;

use 
    App\Models\StoryVk;


class Home extends Controller{    
public function index(){
///*/ Вкладка ///*/
$p = (!empty($_GET['p'])) ? $_GET['p'] : 1;
//$stor = new \VK\Client\Actions\Stories;

//pa($stor = json_decode(file_get_contents('https://api.vk.com/method/stories.get?v=5.131&access_token=vk1.a.nSCEXB7QWMAJyoF9w5FWjTXzdDJBwUx--HIdD6WTe-sPbzBMTVH09ktmCaT5yCHkXn859izVjjpu_R5gDb5jqxOy22XcslyzQrol1t38lWF1xMv3ihIzoH9AJZIHDLc1vtPyvblMY89r26ZEwLcT6OdpRYM_WmQtMoeSxBQx5_UWaK3txUw1Xhmv0YNS1yYEWPywIAZbxPutwYzP2Jcf_A')));

$vkIds = (new TgBot())->vkIdGet('users', ['user_ids'  => ['volgodonsk_volgodonsk, mylife_story, kastega', 'rina1717']]);
ob_start(); pa($vkIds); $vkIdGet = ob_get_contents(); ob_end_clean();
//$bot->sendMessage($cid, " vkIdGet: ". $vkIdGet);
 for($i=0,$c=count($vkIds); $i<$c; $i++){$vkStoriesGet = (!empty((int) $id = $vkIds[$i]['id'])) ? (new TgBot())->vkStoriesGet($id, true) : '';}

//pa((new TgApi)->set());
dump(getenv('TELEGRAM_BOT_TOKEN')); exit; 
pa((new TgApi)->show());
pa($vkIds);                                 
pa($vkStoriesGet); exit;                                 
//pa((new TgBot())->vkIdGet('users', ['user_ids'  => [$p], 'fields' => ['city', 'photo']], true)); exit;       
return view('front.undefine',['deal' => []]);}


//
/*
$request->validate([
    'id' => 'required|regex:/^\d+$/u',
    'tab' => 'required|regex:/^[a-z_]+$/u',
    'deal_id' => 'required',
    'deal_into_id' => 'required',
    //'deal_id' => 'nullable|date',
]);
$structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null; ///*/// array_fill_keys(array_keys($structura) -> берём ключи массива $structura и делаем пустой массив с ключами 


}