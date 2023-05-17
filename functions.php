<?php 
if(!function_exists('pa')){
    function pa($a,$br=0,$t='pre'):bool{$backtrace = debug_backtrace(); $fileinfo = '';$sbr='';
        if(!empty($backtrace[0]) && is_array($backtrace[0])){$fileinfo = $backtrace[0]['file'] . ":" . $backtrace[0]['line'];}
        while($br){$sbr.='<br>';$br--;}
        echo $fileinfo.$sbr.'<'.$t.'>'; print_r($a=(!empty($a)?$a:[])); echo'</'.$t.'>';
        return true;
}}
if (!function_exists('pn')){
function pn($flag = true){$namespaces = array();
if(true == $flag){
    foreach(get_declared_classes() as $name) {
        if(preg_match_all("@[^\\\]+(?=\\\)@iU", $name, $matches)) {
            $matches = $matches[0];
            $parent = &$namespaces;
            while(count($matches)){
                $match = array_shift($matches);
                if(!isset($parent[$match]) && count($matches))
                    $parent[$match] = array();
                $parent =&$parent[$match];
            }
        }
    }
}else{$namespaces = get_declared_classes();}
    return (!empty($namespaces)) ? $namespaces : false;
}}