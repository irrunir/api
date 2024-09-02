<?php
error_reporting(0);

$post_url = $_GET['url'];
$proxies_file = $_GET['proxy'];
$post_url .= '?embed=1';
$proxies = explode("\n", file_get_contents($proxies_file));
$gecko = 1;
$mozilla = 0;
foreach ($proxies as $proxy) {
    $user_agent = 'User-Agent: Mozilla/5.'.$mozilla.'(X11; Linux x86_64; rv:52.0) Gecko/'.$gecko.' Firefox/52.'.$mozilla;
    $mozilla++;
    $gecko++;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['User-Agent: '.$user_agent]);
    curl_setopt($ch, CURLOPT_URL, $post_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
    $result = curl_exec($ch);
    if ($result === false) {
        echo 'bad proxy'.PHP_EOL;
        curl_close($ch);
        continue;
    }
    preg_match('/data-view="(\w+)"/', $result, $matches);
    preg_match('/stel_ssid=(\w+)/', $result, $session);
    $ssid = $session[1];
    curl_setopt($ch, CURLOPT_URL, $post_url.'&view='.$matches[1]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Requested-With: XMLHttpRequest', 'Cookie: stel_ssid='.$ssid, 'User-Agent: '.$user_agent]);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $response_content = curl_exec($ch);
    if ($result === false) {
        echo 'Bad response'.PHP_EOL;
    } else {
        echo 'OK'.PHP_EOL;
    }
    curl_close($ch);
}
?>