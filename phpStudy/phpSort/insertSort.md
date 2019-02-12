## 插入排序

```php

<?php

//假设给定的数组就是排好顺序的，现在把元素插入到排好顺序的数组，而且插入进去之后，新的数组的也是排好顺序的，如此反复

function insertSort($arr)
{
    $count = count($arr);
    
    $tmp = null;
    
    if ($count <= 1) {
        return $arr;
    }
    
    for ($i = 1; $i < $count; $i++) {
        //假设插入元素
        $tmp = $arr[$i];
        
        //内层循环控制，比较插入
        for ($j = $i-1; $j >= 0; $j--) {
            //插入元素和内层元素一个一个比较
            if ($tmp < $arr[$j]) {
                //插入元素比里面的元素小，前后交换位置
                $arr[$j+1] = $arr[$j];
                $arr[$j]   = $tmp;
            } else {
                //插入的元素比里面的元素大
                break;
            }
        }
    }
    return $arr;
}

$arr = [99,15,3,12,39,45,78,65,85];
var_dump(insertSort($arr));
?>

```
