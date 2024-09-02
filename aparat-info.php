<?php
error_reporting(0);
header('content-type:application/json; charset=utf-8');

if(preg_match('/^(http:\/\/|https:\/\/)?(www\.)?aparat\.com\/(.*)\/(\S+)$/sui', $_GET['link'])){
    $get = file_get_contents("http://" . str_replace(['http://','https://','www.'], null, $_GET['link']));
    
    preg_match_all('#<title>(.*?)<\/title>#su', $get, $match_1);
    preg_match_all('#<meta name="twitter\:description" content="(.*?)" \/>#su', $get, $match_2);
    preg_match_all('#<meta property="og\:video\:url" content="(.*?)">#su', $get, $match_3);
    preg_match_all('#<a href="(.*?)".+title="(.*?)".+target="_blank">.+<\/a><\/h3>#su', $get, $match_4);
    preg_match_all('#<meta name="DC\.Publisher" content="(.*?)"\/>#su', $get, $match_5);
    preg_match_all('#<div class="vone\_\_date">(.*?)<\/div>#su', $get, $match_6);
    preg_match_all('#<div class="vone\_\_visits">(\d+)<\/div>#su', $get, $match_7);
    
    $result = ['ok' => true , 'result' => ['title' => $match_1[1][0] , 'view' => (integer) $match_7[1][0] , 'description' => $match_2[1][0] , 'publisher' => $match_5[1][0] , 'date' => $match_6[1][0] , 'download' => $match_3[1][0]]];
    Echo json_encode($result);
}else{
    $result = ['ok' => false , 'result' => "URL or INPUT parameter is Invalid !"];
    Echo json_encode($result);
}
?>