<?php
flush();
error_reporting(0);
function getUrl($url){
    $ch = curl_init(); 
    $timeout = 0; // set to zero for no timeout 
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
    curl_setopt ($ch, CURLOPT_URL, $url); 
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_PROXY, "http://1719da.tgvpnproxy.me"); //your proxy url
    curl_setopt($ch, CURLOPT_PROXYPORT, "1080"); // your proxy port number 
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, "112535:b627846d"); //username:pass 
    $file_contents = curl_exec($ch); 
    curl_close($ch); 
    return $file_contents;
}
$get = file_get_contents("http://whois.irdomain.com/".str_replace(["www.","http://","https://"], null, $_GET['domain']));

preg_match_all('/<br><div>نام مالک : <span dir="ltr">(.*)<\/span><\/div>/s', $get, $match);
$owner = $match[1][0];

preg_match_all('/<div>آی پی سرور: <span dir="ltr">(.*)<\/div>/', $get, $match);
$ip = $match[1][0];

preg_match_all('/<div> محل سرور :(.*)/', $get, $match);
$location = str_replace("\r", null, $match[1][0]);

preg_match_all('/remarks:\s\(Domain Holder Address\) (.*)<br>/', $get, $match);
$address = $match[1][0];

preg_match_all('/nserver:\s(\S+)/', $get, $match);
$dns1 = str_replace("<br>", null, $match[1][0]);
$dns2 = str_replace("<br>", null, $match[1][1]);

$json = array('owner'=>"$owner",'location'=>"$location",'ip'=>"$ip",'address'=>"$address",'dns'=>['1'=>"$dns1",'2'=>"$dns2"]);
header('Content-Type: application/json; charset=utf-8');
Echo json_encode($json);
?>