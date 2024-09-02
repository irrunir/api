<?php
flush();
error_reporting(0);

$img = $_GET['url'];
$filter = $_GET['filter'];

function RandomString(){
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 9; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

//----[Auth]----//
$URL = "https://node-01.faceapp.io/api/v2.9/photos";
$V = "v2.3";
$Did = RandomString();
$user_agent = "FaceApp/1.0.229 (Linux; Android 4.4)";
$filters = ["smile","smile_2","hot","old","young","hollywood","fun_glasses","hitman","pan","heisenberg","female","female_2","male","impression","lion","goatee","hipster","bangs","glasses","wave","makeup"];

if(isset($_GET["img"]) && isset($_GET["filter"])){
    if(filter_var($img, FILTER_VALIDATE_URL)){
        $name = md5(basename($img))."jpg";
        file_put_contents($name,file_get_contents($img));
        $post = array("file" => new CURLFILE("$name", 'image/jpeg', 'image.jpg'));
        
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$URL);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'User-Agent: FaceApp/1.0.229 (Linux; Android 4.4)',
    'X-FaceApp-DeviceID: '.$Did
    ));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $response = json_decode($response,true);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        unlink("$name");
        curl_close($ch);
        if(in_array($status_code, [200, 201, 202])){
            $code = $response["code"];
        }else{
            header('Content-type: application/json');
            echo json_encode(array("Error"=>$response['err'],"Description"=>$response['err']['desc']), JSON_PRETTY_PRINT);
        }
    
    if(isset($code)){
        if(in_array($filter,$filters)){
            $newURL=$URL."/$code/filters/$filter?cropped=true";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$newURL);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'User-Agent: '.$user_agent,
                'X-FaceApp-DeviceID: '.$Did));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            header('Content-type: image/jpeg');
            $res = curl_exec($ch);
            echo $res;
            curl_close($ch);
        }else{
            header('Content-type: application/json');
            echo json_encode(array("Error"=>"Unknown Filter!","Description"=>"Theres No Filter With This ID In Our System!"), JSON_PRETTY_PRINT);
        }
    }
    }else{
        header('Content-type: application/json');
    echo json_encode(array("Error"=>"Invalid Photo Url!","Description"=>"Use An Valid Url!"), JSON_PRETTY_PRINT);
    }
}else{
    header('Content-type: application/json');
  echo json_encode(array("Error"=>"Missing Value!","Description"=>"Fill \"img\" & \"filter\" Parameter!"), JSON_PRETTY_PRINT);
}
?>