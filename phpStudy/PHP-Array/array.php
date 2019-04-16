<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/11
 * Time: 19:06
 */

$arr = [1,3,5,6,3,6,5,8,9,5,9];

function getArr($arr) {
    if (!is_array($arr)) {
        return ['error' => 0];
    }

    $arrLen = count($arr);

    if ($arrLen <=1) {
        return $arr;
    }

    sort($arr);

    //$arr = array_unique($arr);
    $newArr = array_flip($arr);

    $newArr = array_flip($newArr);
    return $newArr = array_merge($newArr);
}

function uniqueArray($arr) {
    $newArr = [];
    for ($i=0;$i<count($arr);$i++) {
        if (!in_array($arr[$i],$newArr)) {
            $newArr[] = $arr[$i];
        }
    }
}


function uniqueArr($arr) {
    if (!is_array($arr)) {
        return ['error' => 0];
    }

    $arrLen = count($arr);

    if ($arrLen <=1) {
        return $arr;
    }

    $tmpArr = [];
    for ($i = 0; $i < $arrLen; $i++) {
        for ($j=1; $j<$arrLen;$j++) {
            if ($arr[$i] == $arr[$j]) {
                $j = ++$i;
            }
            array_push($tmpArr,$arr[$i]);
        }
    }

    return $tmpArr;
}

//var_dump(uniqueArr($arr));

$message = [
    'msgtype' => 'attenTxLvl',
    'level' => intval(12.5)
];
$str = json_encode($message, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

//var_dump($str);

function parseIntTo2Byte($int)
{
    $data = [0, 0];
    $binString = decbin($int);
    $binString = str_pad($binString, 16, '0', STR_PAD_LEFT);
    $data[0] = bindec(substr($binString, -8));
    $data[1] = bindec(substr($binString, 0, 8));
    return $data;
}
var_dump(parseIntTo2Byte(9985)[0]);
var_dump(parseIntTo2Byte(9985)[1]);

function getGsmMsg($srequency)
{
    $arfcn = parseIntTo2Byte($srequency);
    $type = parseIntTo2Byte(0);
    return chr($type[0]).chr($type[1]).chr($arfcn[0]).chr($arfcn[1]);
}


var_dump(getGsmMsg(25));

function parseIntTo4Byte($int)
{
    $data = [0, 0, 0, 0];
    $binString = decbin($int);
    $binString = str_pad($binString, 32, '0', STR_PAD_LEFT);
    $data[0] = bindec(substr($binString, 24));
    $data[1] = bindec(substr($binString, 16, 8));
    $data[2] = bindec(substr($binString, 8, 8));
    $data[3] = bindec(substr($binString, 0, 8));
    return $data;
}

var_dump(parseIntTo4Byte(4));


$str = chr(6)
    . chr(3)
    . chr(0) . chr(0)
    . chr(2)
    . chr(1) . chr(39)
    . chr(6) . chr(0);

var_dump($str);

for ($i=0; $i<=255; $i++) {
    echo $i .'==>'.chr($i) . "\n";
}
