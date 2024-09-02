<?php
error_reporting(0);
header('Content-type: image/gif');
//@bombSource_Bot
$pic = file_get_contents("http://www.beytoote.com/images/Hafez/".rand(1,149).".gif");
Echo $pic;

$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'fal'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('fal', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'fal'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'fal'");
}
?>