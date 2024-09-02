<?php
error_reporting(0);
Header('Content-type: image/jpg');

$token = $_GET['token'];
$gpid = $_GET['gpid'];

$getChat = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$gpid"), true);
$file_id = $getChat['result']['photo']['big_file_id'];
$getFile = json_decode(file_get_contents("https://api.telegram.org/bot$token/getFile?file_id=$file_id"), true);
$path = $getFile['result']['file_path'];
$photo = file_get_contents("https://api.telegram.org/file/bot$token/$path");
Echo $photo;

$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'getgppic'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('getgppic', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'getgppic'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'getgppic'");
}
?>