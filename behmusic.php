<?php
error_reporting(0);
Header('Content-Type: Application/Json');

function search($query,$page){
    $page = $page?$page:0;
    if($page > 1){
        $html = file_get_contents('https://behmusic.com/page/'.$page.'/?s='.urlencode($query));
    }else{
        $html = file_get_contents('https://behmusic.com/?s='.urlencode($query));
    }
    preg_match("/<span class='pages'>صفحه (.*?) از (.*?)<\/span>/",$html,$pages);
    preg_match_all("'<div class=\"post_img\" style=\"text-align:center\"><a href=\"(.*?)\"><img width=\"(.*?)\" height=\"(.*?)\" src=\"(.*?)\" class=\"attachment-medium size-medium wp-post-image\" alt=\"(.*?)\" title=\"(.*?)\" /></a></div>'si",$html,$matchs);
    for($x=0;$x<count($matchs[1]);$x++){
        $id = explode("/",$matchs[1][$x])[3];
        $array = explode('-',explode('/',$matchs[1][$x])[4]); 
        if(in_array('آهنگ',$array)){
            $results[] = ['title'=>str_replace('&#8211;','',$matchs[5][$x]) ,'cover' => $matchs[4][$x] , 'id'=> $id];
        
        }
    }
    if($page < 10){
        if(count($results) >0){
            $array = array('page'=>$page,'count'=> count($results)  , 'results'=> $results);
        }else{
            $array = array('count'=> 0, 'error'=> 'Music Not Found!');
        }
    }else{
        $array = array('count'=> 0, 'error'=> 'Page Not Found!');
    }
    return json_encode($array,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}  
function getID($id){
    $url =file_get_contents('https://behmusic.com/'.$id.'/');
    preg_match_all("'<a class=\"button\" href=\"(.*?)\">(.*?)<a class=\"button\" href=\"(.*?)\">(.*?)</a>'si",$url,$matchs);
    $array = array('results'=>array('128'=>$matchs[3][0],'320'=> $matchs[1][0]));
    return $array;
}
if($_GET['type']=='search'){
    echo search($_GET['query'],
    $_GET['page']);
}
elseif($_GET['type'] == 'download'){
    if(isset($_GET['id'])){
    echo json_encode(getID($_GET['id']),128|256);
    }
}
?>