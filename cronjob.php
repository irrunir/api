<?php
header('content-type:application/json;charset=utf-8');
ini_set("log_errors","off");
$@bomb_Source = 'lr64jlv9c@disbox.org';
$pass = '123456';
if($_GET['link'] !== null and $_GET['time'] !== null){
$time = $_GET['time'];
if($time == 1 or $time == 2 or $time == 5 or $time == 10 or $time == 15 or $time == 30){
function GoldDev($URL){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $URL); curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR,"cooki.txt");
return curl_exec($ch);
curl_close ($ch);
}
$tt = GoldDev('https://cron-job.org/en/members/');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, 'https://cron-job.org/en/members/'); 
curl_setopt($ch, CURLOPT_COOKIEJAR,"cooki.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch , CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("action"=> "login",'@bomb_Source'=>"$@bomb_Source",'pw'=>"$pass"));
$res = curl_exec($ch);
curl_close ($ch);
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => 'https://cron-job.org/en/members/',
CURLOPT_COOKIEJAR => "cooki.txt",
CURLOPT_COOKIEFILE =>"cooki.txt",
CURLOPT_RETURNTRANSFER => TRUE,
CURLOPT_AUTOREFERER => TRUE,
CURLOPT_HEADER => 0,
CURLOPT_FOLLOWLOCATION => TRUE,
]);
$rr = curl_exec($curl);
curl_close ($curl);
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => 'https://cron-job.org/en/members/jobs/',
CURLOPT_COOKIEJAR => "cooki.txt",
CURLOPT_COOKIEFILE =>"cooki.txt",
CURLOPT_RETURNTRANSFER => TRUE,
CURLOPT_AUTOREFERER => TRUE,
CURLOPT_HEADER => 0,
CURLOPT_FOLLOWLOCATION => TRUE,
]);
$rr = curl_exec($curl);
curl_close ($curl);
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => 'https://cron-job.org/en/members/jobs/add/',
CURLOPT_COOKIEJAR => "cooki.txt",
CURLOPT_COOKIEFILE =>"cooki.txt",
CURLOPT_RETURNTRANSFER => TRUE,
CURLOPT_AUTOREFERER => TRUE,
CURLOPT_HEADER => 0,
CURLOPT_FOLLOWLOCATION => TRUE,
]);
$rr = curl_exec($curl);
curl_close ($curl);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, 'https://cron-job.org/en/members/jobs/add/'); 
curl_setopt($ch, CURLOPT_COOKIEJAR,"cooki.txt");
curl_setopt($ch, CURLOPT_COOKIEFILE, "cooki.txt");
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch , CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_POSTFIELDS,array("action"=> 'add',"title"=> 'golddev',"url"=> $_GET['link'],"auth_user"=> "$@bomb_Source","auth_pass"=> "$pass","exec_mode"=> 'interval_minute',"interval_minute_minute"=> $_GET['time'],"day_time_hour"=> '0',"day_time_minute"=> '0',"month_time_day"=> '1',"month_time_hour"=> '0',"month_time_minute"=> '0',"notify_failure"=> 'on',"notify_disable"=> 'on',));
$rr = curl_exec($ch);
curl_close ($ch);
$curl = curl_init();
curl_setopt_array($curl, [
CURLOPT_URL => 'https://cron-job.org/en/members/jobs/',
CURLOPT_COOKIEJAR => "cooki.txt",
CURLOPT_COOKIEFILE =>"cooki.txt",
CURLOPT_RETURNTRANSFER => TRUE,
CURLOPT_AUTOREFERER => TRUE,
CURLOPT_HEADER => 0,
CURLOPT_FOLLOWLOCATION => TRUE,
]);
$rr = curl_exec($curl);
curl_close ($curl);
echo "TRUE";
}else{
echo 'The time parameter in invailed.you most use 1 , 2 , 5 , 10 , 15 or 30 for time parameter.';
}
}else{
echo "inviled parameters ! use 'link' and 'time' parameter in essential.";
}
?>
