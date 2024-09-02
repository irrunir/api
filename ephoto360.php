<?php
header('content-type:application/json;charset=utf-8');
$type=$_GET["type"];
$text = $_GET["text"];
function gethash($type){
$url = "https://en.ephoto360.com/gold-text-effect-$type.html";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url); curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_COOKIEJAR,"ephoto.txt");

               
    $res = curl_exec($ch);
        return $res; 
}
if($type != null && $text !=null){
    


$t= gethash($type);
if($t){
preg_match('/<input type="hidden" name="validator" value="(.*?)" id="validator"><\/dl>/',$t,$day);
     $m2= $day[1];
$url = "https://en.ephoto360.com/gold-text-effect-$type.html";
    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_URL, $url); 
     curl_setopt($ch, CURLOPT_COOKIEFILE, "ephoto.txt");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch , CURLOPT_POST,true);
   curl_setopt($ch, CURLOPT_POSTFIELDS,array('text_1'=> "$text",'login'=>"GO",'validator'=>$m2));
   
       
 $res = curl_exec($ch);
    
        

preg_match('/<input type="hidden"  style= "padding:3px; width:100%;" name="share_link" value="(.*?)-(.*?)" id="share_link">/',$res,$photo);
if($photo[1] != null){
$image = imagecreatefromjpeg($photo[1]);
header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
}
else {
     echo json_encode(['ok'=>false,'error'=>'effect Not Found !'],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
}
}
else{
     echo json_encode(['ok'=>false,'error'=>'Paramete type,text Not Found !'],JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}
?>
