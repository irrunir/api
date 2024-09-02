<?php
flush();
set_time_limit(0);
error_reporting(0);
//--------------------
function Latin($string){
  //arrays of persian and latin numbers
  $persian_num = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
  $latin_num = range(0, 9);
   
  $string = str_replace($persian_num, $latin_num, $string);
   
  return $string;
}
//--------------------
$year = $_GET['year'];
$month = $_GET['month'];
$day = $_GET['day'];
//--------------------
if($year != null and $month != null and $day != null){
    //-----Get URL
    $get = file_get_contents("http://birth.carbalad.com/$year/$month/$day/male/");
    //-----ReGeX
    preg_match_all('/alt="سن دقیق شما"\s\/>\sامروز\s<u>(\S+)<\/u> سال،  <u>(\S+)<\/u> ماه و <u>(\S+)<\/u>/s', $get, $match);
    $y = Latin($match[1][0]);
    $m = Latin($match[2][0]);
    $d = Latin($match[3][0]);
    preg_match_all('/<div class="q">شما امروز <u>(.*?)\s<\/u> روزه/s', $get, $match);
    $days = Latin($match[1][0]);
	preg_match_all('/<div class="q">شما در سال <u>(.*?)<\/u>/s', $get, $match);
    $y_name = $match[1][0];
	preg_match_all('/<div class="q"><u>(.*?)<\/u> روز دیگر تولد </s', $get, $match);
    $left_b = Latin($match[1][0]);
    //-----Print OutPut
    $age = ["year"=>$y,"month"=>$m,"day"=>$d];
    $other = ["days"=>$days,"year_name"=>$y_name,"to_birth"=>$left_b];
    $json = array("ok"=>true,"result"=>$age,"other"=>$other);
    header('Content-Type: application/json; charset=utf-8');
    Echo json_encode($json,JSON_PRETTY_PRINT);
}else{
    //-----Error Parameters
    $json = array("ok"=>false,"Description"=>"Please Complete all Parameters");
    header('Content-Type: application/json; charset=utf-8');
    Echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'age'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('age', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'age'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'age'");
}
?>