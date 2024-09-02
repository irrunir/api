<?php
set_time_limit(-1);
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

function getLink($query, $page = 1){
    $get = file_get_contents("http://nex1music.com/pages/$page/?s=".urlencode($query));
    preg_match_all('/<h2><a href=(.*?)\/>(.*?)<\/a><\/h2>/sui', $get, $array);
    return $array[1];
}
function getCover($link){
    $get = file_get_contents($link);
    preg_match_all('/<p class="ac"><img src="(.*?)"/sui', $get, $array);
    return $array[1][0];
}
function getDirectLink($link){
    $get = file_get_contents($link);
    preg_match_all('/<a href="(.*?)">دانلود آهنگ با کیفیت 320<\/a><a href="(.*?)">دانلود آهنگ با کیفیت 128<\/a><\/div>/sui', $get, $array);
    preg_match('/class=\\"linkdl\\">\\n<a href=\\"(.*)/', $array[1][0], $array_2);
    return ['128'=>$array[2][0],'320'=>$array_2[1]];
}
$result = [];
$getlink = getLink($_GET['query']);
for($i = 0; $i <= count($getlink); $i++){
    $cover = getCover($getlink[$i]);
    $music = getDirectLink($getlink[$i]);
    array_push($result, ['cover'=>$cover,'download'=>$music]);
}
Echo json_encode($result);
?>
