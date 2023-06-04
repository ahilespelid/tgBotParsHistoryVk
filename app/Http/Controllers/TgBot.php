<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use TelegramBot\Api\Client;
use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\ReplyKeyboardMarkup;
use TelegramBot\Api\Types\ReplyKeyboardRemove;
use TelegramBot\Api\Types\Inline\InlineKeyboardMarkup;
use 
    App\Models\User;
//
/*/
https://api.telegram.org/bot5871515444:AAFAaK6eOl9Nc_OIvNvrOVWZxAxt4y2wh1Y/setwebhook?url=https://tgbotparshistoryvk.ahilespelid.ru/uyvf8g76vbd6dklvnrwv5giv
https://oauth.vk.com/oauth/authorize?client_id=6178269&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=notify,friends,photos,audio,video,stories,pages,status,notes,messages,wall,ads,offline,docs,groups,notifications,stats,email,market&response_type=token&v=5.131
///*/

class TgBot extends Controller{
    public $bot, $TgToken;
    
public function __construct(){
    $this->TgToken = '5871515444:AAFAaK6eOl9Nc_OIvNvrOVWZxAxt4y2wh1Y';
    $this->VkToken = 'vk1.a.nSCEXB7QWMAJyoF9w5FWjTXzdDJBwUx--HIdD6WTe-sPbzBMTVH09ktmCaT5yCHkXn859izVjjpu_R5gDb5jqxOy22XcslyzQrol1t38lWF1xMv3ihIzoH9AJZIHDLc1vtPyvblMY89r26ZEwLcT6OdpRYM_WmQtMoeSxBQx5_UWaK3txUw1Xhmv0YNS1yYEWPywIAZbxPutwYzP2Jcf_A';
    
    if(!file_exists("bot.txt")){
        if((new Client($this->TgToken))->setWebhook($page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"])){file_put_contents("bot.txt", $page_url.' - '.date('Y-m-d H:i:s').PHP_EOL);}
    }
return null;}    

public function index(Request $request):?bool{
    header('Content-Type: text/html; charset=utf-8');
    ///*/ pa($this->bot); exit; ///*/ pa(); exit;
    
    $client = new Client($this->TgToken); $bot = new BotApi($this->TgToken);
    $dontboard = new ReplyKeyboardRemove();
    
    $comands = include resource_path('arrays'.DIRECTORY_SEPARATOR .'comands.php');
    
    ///*/ /start обязательное. На главную ///*/
    $client->command('start', function ($up) use ($bot,$comands){
        $cid = $up->getChat()->getId();
        $answer = 'Ввведите ссылку на аккаунт или никнейм';
        if(is_array($comands) && !empty($comands)){
            $keyboard = new ReplyKeyboardMarkup([array_map(function($c){return '/'.$c;}, array_keys($comands))], true);
            $bot->sendMessage($cid, $answer, null, true, null, $keyboard);
        }else{$bot->sendMessage($cid, $answer);}
    });
   ///*/ /help обязательное. Помощь ///*/
    $client->command('help', function ($up) use ($bot,$comands,$dontboard){
        $cid = $up->getChat()->getId();    
        $answer = 'Команды:'.PHP_EOL;
        foreach($comands as $k => $v){$answer .= '         /'.$k.' - '.$v.PHP_EOL;}
  
        $keyboard = new ReplyKeyboardRemove();
        $bot->sendMessage($cid, $answer, null, true, null, $dontboard);
  
    });
    ///*/ /tariffs Тарифы ///*/
    $client->command('tariffs', function ($up) use ($bot,$dontboard){
        $cid = $up->getChat()->getId();
        $answer = 'Тарифы:'.PHP_EOL.
                  '1             - 50'.PHP_EOL.
                  '10           - 350'.PHP_EOL.
                  '100         - 2000'.PHP_EOL.
                  'no limit - 10000';     
   
        $bot->sendMessage($cid, $answer, null, true, null, $dontboard);    
    });
    ///*/ /subscriptions Подписки ///*/
    $client->command('subscriptions', function ($up) use ($bot,$dontboard){
        $cid = $up->getChat()->getId();
        $answer = 'Подписки:';    
        $bot->sendMessage($cid, $answer, null, true, null, $dontboard);    
    });
    ///*/ /balance Баланс ///*/
    $client->command('balance', function ($up) use ($bot,$dontboard){
        $cid = $up->getChat()->getId();
        $answer = 'Баланс:';    
        $bot->sendMessage($cid, $answer, null, true, null, $dontboard);    
    });

    ///*/ Ловим пользовательский ввод ///* /
    $client->on(function($up) use ($bot,$client) {
        $obj = $up->getMessage();    
        $mes = $obj->getText();
        $cid = $obj->getChat()->getId();
        $lmes = mb_strlen($mes); $rtext = '';
        
        $vkIds = $this->vkIdGet('users', ['user_ids'  => [$mes]]);
        ob_start(); pa($vkIds); $vkIdGet = ob_get_contents(); ob_end_clean();
        $bot->sendMessage($cid, " vkIdGet: ". $vkIdGet);
        
        for($i=0,$c=count($vkIds); $i<$c; $i++){$vkStoriesGet []= (!empty((int) $id = $vkIds[$i]['id'])) ? $this->vkStoriesGet($id) : '';}
        //foreach($vkStoriesGet as $send){(new Client($this->TgToken))->sendMessage($cid, " vkStoriesGet: ". $send);}
        
            
                   
        //if(3 <= $lmes && 32 >= $lmes){}else{$rtext = 'Введи что-то рабочее';}  ob_start(); pa($message); $rtext = ob_get_contents(); ob_end_clean();
    }, function($obj){return true;});///*/

    ///*/ Запускаем обработку ///*/
    $client->run();
return null;}

public function vkIdGet(string $method, array $parametrs = ['user_ids'  => [1], 'fields' => ['city', 'photo']], bool $retString = false){
    try{
        $response = (new \VK\Client\VKApiClient)->{$method}()->get($this->VkToken, $parametrs);
    }catch(\Exception $e){$response = '';}
    ob_start(); pa($response); $ret = ob_get_contents(); ob_end_clean();
return ($retString) ? $ret : $response;}

public function vkStoriesGet(string $id, bool $retString = false){
    if(empty($id)){return null;} $response = []; 
    try{
        $json = json_decode(file_get_contents('https://api.vk.com/method/stories.get?v=5.131&owner_id='.$id.'&access_token='.$this->VkToken), true);
        if(!empty($items = $json['response']['items']) && is_array($items)){
            foreach($items as $item){
                if(!empty($stories = ($item['stories']) ?? null) && is_array($stories)){
                    foreach($stories as $storie){
                        if(!empty($storie['photo'])){
                            $size = (is_array($storie['photo']['sizes'])) ? $storie['photo']['sizes'][max(array_keys($storie['photo']['sizes']))] : null;
                            if(!empty($size['url'])){$response[] = $size['url'];}
                        }
                        if(!empty($storie['video'])){
                            if(is_array($storie['video']['files'])){
                                $file = ($storie['video']['files']['mp4_1080']) ?? 
                                            (($storie['video']['files']['mp4_720']) ?? 
                                                (($storie['video']['files']['mp4_480']) ?? 
                                                    (($storie['video']['files']['mp4_360']) ?? 
                                                        (($storie['video']['files']['mp4_240']) ?? 
                                                            (($storie['video']['files']['mp4_144']) ?? null)))));
                                if($file){$response[] = $file;}
                        }}
                        if(!empty($storie['link'])){
                            $response[] = $storie['link']['text'];
                        }                                
        }}}}
    }catch(\Exception $e){$json = '';}
    ob_start(); pa($json); $ret = ob_get_contents(); ob_end_clean();
return ($retString) ? $ret : $response;}


}