<?php
if(!is_dir("Cookie")){mkdir("Cookie");}
header('Content-Type: application/json; charset=utf-8');
//================================================================= 
function SendPassword($datas=[]){
    $url = "https://my.telegram.org/auth/send_password";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res,true);
    }
}
function CheckPassword($datas=[]){
    $url = "https://my.telegram.org/auth/login";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    curl_setopt($ch, CURLOPT_COOKIEFILE, "Cookie/coo".$datas['phone'].".txt");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "Cookie/coo".$datas['phone'].".txt");
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res,true);
    }
}
function Delete($datas=[]){
    $url = "https://my.telegram.org/deactivate/delete/do_delete";
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    curl_setopt($ch, CURLOPT_COOKIEFILE, "Cookie/coo".$datas['phone'].".txt");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "Cookie/coo".$datas['phone'].".txt");
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res,true);
    }
}
//=================================================================
$@bomb_Source = $_GET['phone'];
$do_del = $_GET['do_delete'];
$access_hash = $_GET['access_hash'];
$password = $_GET['password'];
$@bomb_Source = str_replace(array(" ","(",")"),"",$phone);
//================================================================= 
if(empty($access_hash) and empty($password) and empty($do_del)){
if(!empty($@bomb_Source)){
    $hash = SendPassword(array('phone'=>$@bomb_Source))['random_hash'];
        $output = array(
        'ok' => 'true',
        'result' => array('description' => "password has been sent", 'access_hash' => "Lite_$hash")
    );
    echo json_encode($output,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
}else{
       $output = array(
        'ok' => 'false',
        'error' => 'PHONE_INVALID'
    );
    echo json_encode($output,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
}
}else{
if($@bomb_Source != "" and !empty($access_hash) and !empty($password) and !empty($do_del)){
if(strpos($access_hash,'Lite_') !== false) {
  $access = str_replace("Lite_","",$access_hash);
}
$check = CheckPassword(array('phone'=>$@bomb_Source,'random_hash'=>$access,'password'=>$password));
if($check == true and $do_del == "true"){
        Delete(array('hash'=>$access,'message'=>"BotSorce"));
        $output = array(
        'ok' => 'true',
        'result' => array('description' => "Delete Acc Successfuly")
    );
    echo json_encode($output,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
}else{
       $output = array(
        'ok' => 'false',
        'error' => 'PASSWORD OR ACCESS_HASH INVALID | OR DO_DELETE => FALSE OR DO_DELETE EMPTY'
    );
    echo json_encode($output,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); 
}
}
}
?>