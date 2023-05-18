<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use TelegramBot\Api\Client;
use 
    App\Models\FirstInstance;

class TgBot extends Controller{
public function __construct(protected string $token = '5871515444:AAFAaK6eOl9Nc_OIvNvrOVWZxAxt4y2wh1Y', public Client $bot){
    $this->bot = new Client($this->token);

    if (!file_exists("bot.txt")){
        if($this->bot->setWebhook($page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"])){file_put_contents("bot.txt", $page_url.' - 'time().PHP_EOL);}
    }
}    

public function index(Request $request){
    header('Content-Type: text/html; charset=utf-8');
    ///*/ pa($_POST); exit; ///*/

    pa($bot); exit;
 
    $bot->on(function($up) use ($bot) {
        $message = $up->getMessage();    
        $text = $message->getText();    
        $cid = $message->getChat()->getId();    
        if(mb_stripos($text,"привет") !== false) {
            $bot->sendMessage($message->getChat()->getId(), "Здраствуйте, чувак!");    
        }    
    }, function($message) use ($name) {    
        return true; // когда тут true - команда проходит    
    }); 
 
 
    
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
}
}