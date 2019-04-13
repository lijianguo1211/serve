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

var_dump(uniqueArr($arr));
