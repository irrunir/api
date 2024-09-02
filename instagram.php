<?php
header('Content-Type: application/json');
error_reporting(0);
function @bomb_Source($username){
    $html = file_get_contents('https://instagram.com/'.$username);
    preg_match_all("'<script type=\"text/javascript\">window._sharedData = (.*?)</script>'si",$html,$match);
    $instagram =  str_replace(';','',$match[1][0]);
    $instagram = json_decode($instagram,true)['entry_data']['ProfilePage'][0]['graphql']['user'];
    $array = array('result'=>false,'description'=>'Instagram page not found!');
    if($instagram != null){
        return array('result'=>true,'results'=>$instagram);
    }else{
        return $array;
    }
}
$username = str_replace('@','',$_GET['username']);
if(isset($_GET['username'])){
    echo json_encode(@bomb_Source($username),128|256);
}