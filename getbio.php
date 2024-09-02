<?php//@bombSource_Bot
error_reporting(0);
$id = $_GET['userid'];
if(isset($id)){
	$get = file_get_contents("http://t.me/".$id);
	preg_match('/property="og:description" content="(.*)"/', $get, $match);
	Echo $match[1];
}
$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'bio'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('bio', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'bio'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'bio'");
}
?>