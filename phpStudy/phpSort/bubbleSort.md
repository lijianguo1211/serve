## 冒泡排序

```php

<?php
$arr = [1,16,5,3,19,66,25];

$strlen = count($arr);

$tmp = null;
//该层循环控制 需要冒泡的轮数
for ($i = 1; $i < $strlen; $i++) {
    //该层循环用来控制每轮 冒出一个数 需要比较的次数
    for ($j = 0; $j < $strlen-$i; $j++) {
        if ($arr[$j] > $arr[$j+1]) {
            $tmp = $arr[$j+1];
            $arr[$j+1] = $arr[$j];
            $arr[$j] = $tmp;
        }
    }
}

var_dump($arr);

?>

```
