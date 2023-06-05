<?php namespace App\Telegram;

class Token{
    public $url, $code;
public function __construct(string $url, string $code){$this->set($url, $code);}
public function get(){return $this;}
public function set(string $url, string $code){
    $this->url = $url; $this->code = $code;    
return $this;}
}