<?php
error_reporting(0);

$url = $_GET['url'];
$filter = $_GET['filter'];


header('Content-type: image/png');

$array = [1,2,3,4,5,6,7,8,9,10];
if(!in_array($filter, $array)){
    header('Content-Type: application/json');
    $json = array('ok'=>false,'Description'=>"Effect Number Not Found!");
	Echo json_encode($json);
	exit();
}
elseif($filter == 1){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_EMBOSS);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 2){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_NEGATE);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 3){
	$arg = $_GET['arg'];
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_GRAYSCALE,$arg);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 4){
	$arg = $_GET['arg'];
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_BRIGHTNESS ,$arg);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 5){
	$arg = $_GET['arg'];
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_CONTRAST,$arg);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 6){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_EDGEDETECT);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 7){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 8){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_SELECTIVE_BLUR);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 9){
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_MEAN_REMOVAL);
	imagepng($im);
	imagedestroy($im);
}
elseif($filter == 10){
	$arg = $_GET['arg'];
	$im = imagecreatefromjpeg($url);
	imagefilter($im, IMG_FILTER_SMOOTH,$arg);
	imagepng($im);
	imagedestroy($im);
}
?>