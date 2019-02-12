## 选择排序

```php

<?php
$arr = [1,16,5,3,19,66,25];

$strlen = count($arr);

$tmp = null;
//外层控制轮数，内层控制比较次数
for ($i = 0; $i < $strlen-1; $i++) {
    $p = $i;
    for ($j = $i+1; $j < $strlen; $j++) {
        if ($arr[$p] > $arr[$j]) {
            $p = $j;
        }
    }
    
    if ($p != $i) {
        $tmp = $arr[$p];
        $arr[$p] = $arr[$i];
        $arr[$i] = $tmp;
    }
}

var_dump($arr);

?>

```
