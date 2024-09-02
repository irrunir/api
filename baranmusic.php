<?php
error_reporting(0);
header('Content-Type: application/json; charset=utf-8');

$get = file_get_contents("http://baran-music.com/?s=".urlencode($_GET['query']));

function getLink($query, $page = 1){
    $get = file_get_contents("http://baran-music.com/page/$page/?s=".urlencode($query));
    preg_match_all('/<li class="tit"><h2><a href="(.*?)\/">(.*?)<\/a><\/h2><\/li>/sui', $get, $array);
    return $array[1];
}
function getResult($link){
    $get = file_get_contents($link);
    preg_match_all('/<div><a href="(.*?)"><i class="fa fa\-download"><\/i>.+<\/a><\/div>  <div><a href="(.*?)"><i class="fa fa\-download"><\/i>.+<\/a><\/div> <\/div>/sui', $get, $array);
    preg_match_all('/<div><a href="(.*)$/', $array[1][0], $array_2);
    preg_match_all('/<img class="(.*?)" src="(.*?)" alt/sui', $get, $array_3);
    preg_match('/<title>(.*?)<\/title>/s', $get, $array_4);
    return ['title'=>trim(str_replace(["دانلود آهنگ","» آهنگ جدید"], null, $array_4[1])),'cover'=>$array_3[2][0],'128'=>$array_2[1][0],'320'=>$array[2][0]];
}
preg_match("/<a class='page-numbers' href='(.*?)'>(\d+)<\/a>/", $get, $array); $count = $array[2]; $getlink = []; $i = 0;
while($i <= $count){
    $i++;
    $getlink[] = getLink($_GET['query'], $i);
}
$result = []; $count = count($getlink);
for($i = 0; $i <= $count; $i++){
    for($x = 0; $x <= count($getlink[$i]); $x++){
        $link = $getlink[$i][$x];
        $res = getResult($link);
        if(empty($res['cover']) === false and empty($res['128']) === false and empty($res['320']) === false){
            $result[] = ['result'=>$res];
        }
    }
}
Echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
?>