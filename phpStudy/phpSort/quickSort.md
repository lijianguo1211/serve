## 快速排序

```php

<?php

$arr = [1,58,99,66,25,16,59,66];

function quickSort($arr)
{
    $strlen = count($arr);
    
    if ($strlen <= 1) {
        return $arr;
    }
    
    $leftArr = $rightArr = [];
    $tmp = null;
    $baseNum = null;
    //选择一个基准元素，假设它就是最小的
    $baseNum = $arr[0];
    
    for ($i = 1; $i < $strlen; $i++) {
        //让第一个元素和假设的最小的基准元素比较
        if ($baseNum > $arr[$i]) {
            //小于假设元素的放在左边数组
            $leftArr[] = $arr[$i];
        } else {
            //大于假设元素的放在右边数组
            $rightArr[] = $arr[$i];
        }
    }
    
    //递归处理左边右边的
    $leftArr  = quickSort($leftArr);
    $rightArr = quickSort($rightArr);
    
    //数组合并 array_merge();
    return array_merge($leftArr,(array)$baseNum,$rightArr);
}

var_dump(quickSort($arr));
?>
```
