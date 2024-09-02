<?php
error_reporting(0);

$text = $_GET['text'];

function utf8_strrev($str){
    preg_match_all('/.*?/us', $str, $ar);
    $rev = array_reverse($ar[0]);
    return implode(null, $rev);
}
function is_english($str){
    return strlen($str) == mb_strlen($str,'utf-8');
}
//-----------------------------------------------
if(is_english($text) == true){
    Echo strrev($text);
}else{
    Echo utf8_strrev($text);
}
?>