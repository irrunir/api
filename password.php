<?php
error_reporting(0);

function password_gen($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_-=+;?";
    $password = substr(str_shuffle($chars),0,$length);
    return $password;
}

$length = isset($_GET['length']) ? $_GET['length'] : 8;
Echo password_gen($length);
?>