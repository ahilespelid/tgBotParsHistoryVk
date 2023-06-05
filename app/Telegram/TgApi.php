<?php namespace App\Telegram;

use Illuminate\Http\Request;
use \Telegram;
class TgApi{
    public $token, $telegram;

//public function __construct(){pa((new \Telegram\Bot\Api));}
public function __construct(){
    //pa($_SERVER['SERVER_NAME']);
    
    $this->token = (new Token('https://'.getenv('SERVER_NAME').'/', getenv('TELEGRAM_BOT_TOKEN'))); 
    $this->telegram = new \Telegram\Bot\Api;
    
    if(!file_exists(resource_path('bot.txt'))){
        if($hurl = $this->setHook()){file_put_contents(resource_path('bot.txt'), $hurl.' - '.date('Y-m-d H:i:s').PHP_EOL);}
    }        
}

public function index(Request $request){
    $update = Telegram::commandsHandler(true);
    $updates = Telegram::getWebhookUpdate();
    
return 'ok';}

public function setHook(){
    $hurl = 'https://api.telegram.org/bot'.$this->token->code.'/setwebhook?url='.($url = $this->token->url.$this->token->code);
return ($response = \Telegram::setWebhook(['url' => $hurl])) ? $hurl : $response;}

public function show(){
    $response = $this->telegram->getMe();
return $response;}
}