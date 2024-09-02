<?php
error_reporting(0);
header('Content-type: image/png');

$get = file_get_contents("http://webshot.okfnlabs.org/api/generate?url=".$_GET['url']);
Echo $get;
?>