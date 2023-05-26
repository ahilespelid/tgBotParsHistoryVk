<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use TelegramBot\Api\Client;
use 
    App\Models\FirstInstance;

class TgBot extends Controller{
    public $bot, $token;
    
public function __construct(){
    $this->token = '5871515444:AAFAaK6eOl9Nc_OIvNvrOVWZxAxt4y2wh1Y';
    
    if (!file_exists("bot.txt")){
        $bot = new Client($this->token);
        //pa(
        $res = $bot->setWebhook($page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]); 
        //);
        if($res){file_put_contents("bot.txt", $page_url.' - '.date('Y-m-d H:i:s').PHP_EOL);}
    }
}    

public function index(Request $request):?bool{
    header('Content-Type: text/html; charset=utf-8');
    ///*/ pa($this->bot); exit; ///*/ pa(); exit;
    $bot = new Client($this->token);

    // обязательное. Запуск бота
    $bot->command('start', function ($message) use ($bot) {
        $answer = 'введите ссылку на аккаунт или никнейм';    
        $bot->sendMessage($message->getChat()->getId(), $answer);    
    });

    // помощь
    $bot->command('help', function ($message) use ($bot) {    
        $answer = 'Команды: /help - помощь';
        $bot->sendMessage($message->getChat()->getId(), $answer);    
    });
    $name = 'a';
    $bot->on(function($Update) use ($bot) {
        $message = $Update->getMessage();    
        $mtext = trim($message->getText());    
        $cid = $message->getChat()->getId();    
        if(30 > iconv_strlen($mtext)){
            $rtext = (new TgBot())->vk_get('users', ['user_ids'  => [$mtext], 'fields' => ['city', 'photo']]);
        }else{
            $rtext = 'Слишком длинный vk ник, чувак.';
        }
        $bot->sendMessage($message->getChat()->getId(), $rtext);    
    }, function($message) use ($name) {    
        return true; // когда тут true - команда проходит    
    });


    // запускаем обработку
    $bot->run();
    

    //
    /*
    
    $request->validate([
        'id' => 'required|regex:/^\d+$/u',
        'tab' => 'required|regex:/^[a-z_]+$/u',
        'deal_id' => 'required',
        'deal_into_id' => 'required',
        //'deal_id' => 'nullable|date',
    ]);

    $request->updated_at = date('Y-m-d H:i:s');
    
    $structura = include resource_path('arrays'.DIRECTORY_SEPARATOR .$request->tab.'.php');
    foreach($structura as $k => $v){if('m' == $structura[$k]['type']){unset($structura[$k]);}}
    $structura = (is_array($structura)) ? array_fill_keys(array_keys($structura), '') : null;
    $structura = ['id'=>'']+$structura+['updated_at'=>''];
    ///*/
return null;}

public function vk_get(string $method, array $parametrs = ['user_ids'  => ['ahilespelid',1],'fields' => ['city', 'photo'],], 
string $access_token = 'vk1.a.crUp1bWHr9NSsMubTrfaltQPmX5PVIV45LzzRXtGl7RpYbV9vb5iWFSgB6ekmXzXjcQBCmDiUwBiZJew1ew0bmWhDxeSojf2Si-JEsNa5AmwLMIsWbWPWVFbqKYDjVOYdLeqpaUVvUkv1UJul0dLnSWTupGkFNMWwGChF1Hf8P4A03lCZ7rqcfKYDUeFCKfr8nolZFvVjJclP2dOoNltog'){
     
    try{
        $vk = new \VK\Client\VKApiClient();
        $response = $vk->{$method}()->get($access_token, $parametrs);
        
        
    }catch(\Exception $e){$response = '';}
    
    
    
    ob_start(); pa($response); $ret = ob_get_contents(); ob_end_clean();
return $ret;}

}