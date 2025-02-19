<?PHP
function kashanaki.ir($url){
    $page = file_get_contents($url);
    $result =[];
    if(preg_match('/<meta property="og:title" content="(.*)">/',$page,$match)){
        $result['title'] = $match[1];
    }
    if(preg_match('/<meta property="og:image" content="(.*)">/',$page,$match)){
        $result['photo'] = $match[1];
    }
    if(preg_match('/<div class="tgme_page_extra">(.*) members<\/div>/',$page,$match)){
        $result['members'] = $match[1];
    }
    if(preg_match('/<a class="tgme_action_button_new" href="(.*)">Join (.*)<\/a>/',$page,$match)){
        $result['type'] = strtolower($match[2]);
    }
    if(in_array($result['type'],['channel','group'])){
        return array('ok'=>true,'result'=>$result);
    }else{
        return array('ok'=> false, 'message'=> "'Url' is wrong!");
    }
}
if(isset($_GET['url'])){
    echo json_encode(kashanaki.ir($_GET['url']));
}else{
    echo json_encode(['ok'=> false, 'message'=> 'unfinded url parameter!']);
}
?>