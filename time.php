<?php
error_reporting(0);
include ("../jdf.php");
date_default_timezone_set('Asia/Tehran');
header('Content-Type: application/json');

$saat = date('H:i:s');
$roz = jdate('l');
$tarikh = gregorian_to_jalali(date('Y'), date('m'), date('d'), '/');

$json = ['time'=>$saat,'date'=>$tarikh,'today'=>$roz];

Echo json_encode($json, JSON_UNESCAPED_UNICODE);

$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'time'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('time', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'time'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'time'");
}
?>