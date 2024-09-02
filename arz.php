<?php
error_reporting(0);
function xmlToArray(SimpleXMLElement $parent)
{
    $array = array();

    foreach ($parent as $name => $element) {
        ($node = & $array[$name])
            && (1 === count($node) ? $node = array($node) : 1)
            && $node = & $node[];

        $node = $element->count() ? xmlToArray($element) : trim($element);
    }

    return $array;
}

header('content-type:application/json');
$xml = 'http://parsijoo.ir/api?serviceType=price-API&query=Currency';
$xml = simplexml_load_file($xml);
function EnglishNum($num){
    return str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],range(0,9),$num);
}
$xml = array_values(xmlToArray($xml)['sadana-services']['price-service']['item']);
$xml[] = ['name'=> $xml[0],'price'=> $xml[1],'change'=> $xml[2],'percent'=> $xml[3]];
unset($xml[0],$xml[1],$xml[2],$xml[3]);
echo EnglishNum(json_encode(array_values($xml),128|256));
?>
