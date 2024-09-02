<?php
error_reporting(0);
header('Content-Type: application/json');

$string = $_GET['text'];

function is_English($str){
    $up = strtoupper($str);
    if(preg_match('/^[QWERTYUIOPASDFGHJKLZXCVBNM\s]+$/', $up)){
        return true;
    }
}

if(is_English($string) !== true){
	$json = array('ok'=>false,'Description'=>"Only English input is allowed!");
	Echo json_encode($json);
	exit();
}
$matn = strtoupper($string);
$Eng = ['Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M'];

//Fonts
$Font_1 = ['ⓠ','ⓦ','ⓔ','ⓡ','ⓣ','ⓨ','ⓤ','ⓘ','ⓞ','ⓟ','ⓐ','ⓢ','ⓓ','ⓕ','ⓖ','ⓗ','ⓙ','ⓚ','ⓛ','ⓩ','ⓧ','ⓒ','ⓥ','ⓑ','ⓝ','ⓜ'];
$Font_2 = ['⒬','⒲','⒠','⒭','⒯','⒴','⒰','⒤','⒪','⒫','⒜','⒮','⒟','⒡','⒢','⒣','⒥','⒦','⒧','⒵','⒳','⒞','⒱','⒝','⒩','⒨'];
$Font_3 = ['🇶 ','🇼 ','🇪 ','🇷 ','🇹 ','🇾 ','🇺 ','🇮 ','🇴 ','🇵 ','🇦 ','🇸 ','🇩 ','🇫 ','🇬 ','🇭 ','🇯 ','🇰 ','🇱 ','🇿 ','🇽 ','🇨 ','🇻 ','🇧 ','🇳 ','🇲 '];
$Font_4 = ['զ','ա','ɛ','ʀ','t','ʏ','ʊ','ɨ','օ','ք','a','s','ɖ','ʄ','ɢ','ɦ','ʝ','ҡ','ʟ','ʐ','x','ᴄ','ʋ','ɮ','ռ','ʍ'];
$Font_5 = ['ǫ','ᴡ','ᴇ','ʀ','ᴛ','ʏ','ᴜ','ɪ','ᴏ','ᴘ','ᴀ','s','ᴅ','ғ','ɢ','ʜ','ᴊ','ᴋ','ʟ','ᴢ','x','ᴄ','ᴠ','ʙ','ɴ','ᴍ'];
$Font_6 = ['ᑫ','ʷ','ᵉ','ʳ','ᵗ','ʸ','ᵘ','ᶦ','ᵒ','ᵖ','ᵃ','ˢ','ᵈ','ᶠ','ᵍ','ʰ','ʲ','ᵏ','ˡ','ᶻ','ˣ','ᶜ','ᵛ','ᵇ','ⁿ','ᵐ'];
$Font_7 = ['ǫ','ш','ε','я','т','ч','υ','ı','σ','ρ','α','ƨ','ɔ','ғ','ɢ','н','נ','κ','ʟ','z','х','c','ν','в','п','м'];
$Font_8 = ['φ','ω','ε','Ʀ','†','ψ','u','ι','ø','ρ','α','Տ','ძ','δ','ĝ','h','j','κ','l','z','χ','c','ν','β','π','ʍ'];

//Replace
$a = str_replace($Eng,$Font_1,$matn);
$b = str_replace($Eng,$Font_2,$matn);
$c = trim(str_replace($Eng,$Font_3,$matn));
$d = str_replace($Eng,$Font_4,$matn);
$e = str_replace($Eng,$Font_5,$matn);
$f = str_replace($Eng,$Font_6,$matn);
$g = str_replace($Eng,$Font_7,$matn);
$h = str_replace($Eng,$Font_8,$matn);

$result = ['1'=>"$a",'2'=>"$b",'3'=>"$c",'4'=>"$d",'5'=>"$e",'6'=>"$f",'7'=>"$g",'8'=>"$h"];
$json = array('ok'=>true,'result'=>$result);
Echo json_encode($json,JSON_UNESCAPED_UNICODE);

$connect = @new MySqli('localhost', 'novatea1_ramin6rr', 'ramin20924313', 'novatea1_api');
if(empty(mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'font'")))){
    $connect->query("INSERT INTO `api` (name, count) VALUES ('font', '0')");
}else{
    $count = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `api` WHERE `name` = 'font'"))['count']+1;
    $connect->query("UPDATE `api` SET count = '$count' WHERE name = 'font'");
}
?>