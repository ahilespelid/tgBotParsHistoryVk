<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use 
    App\Models\FirstInstance;

class BotController extends Controller{    
public function index(Request $request){
    header('Content-Type: text/html; charset=utf-8');
    ///*/ pa($_POST); exit; ///*/
    $bot = new \TelegramBot\Api\Client('5871515444:AAFAaK6eOl9Nc_OIvNvrOVWZxAxt4y2wh1Y');
    if (!file_exists("registered.trigger")) {
        /**    
        * файл registered.trigger будет создаваться после регистрации бота.    
        * если этого файла не существует, значит бот не    
        * зарегистрирован в Телеграмм    
        */// URl текущей страницы    
        if($result = $bot->setWebhook($page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"])){file_put_contents("registered.trigger",time());}
    }

    pa($bot); exit;
    
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