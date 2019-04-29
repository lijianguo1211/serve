<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-29
 * Time: 20:42
 */

namespace App\Http\Controllers\Admin;


class SortController
{
    /**
     * 快速排序
     * @param array $arr
     * @return array
     */
    public static function quickSort(array $arr)
    {
        if (!is_array($arr)) {
            return ['info'=>'this is not array'];
        }

        $count = count($arr);

        if ($count <=1) {
            return $arr;
        }

        /**
         * 定义两个数组，大的放在左边，小的放在右边。
         */
        $right = $left = [];

        /**
         * 假设数组的第一个元素就是最小的元素，以最小元素为基准进行比较
         */
        $base = $arr[0];

        /**
         * for循环，假设了第一个元素是最小元素，所以从第二个元素开始循环比较。
         */
        for($i=1; $i<$count; $i++) {
            if ($base > $arr[$i]) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }

        /**
         * 循环递归，直到没有比最小元素小的元素
         */
        $left = static::quickSort($left);
        $right = static::quickSort($right);

        /**
         * 利用PHP的原生函数array_merge().合并三个数组，最后返回
         */
        return $arr = array_merge($left,(array)$base,$right);
    }

    public static function bubbleSort($arr)
    {
        if (!is_array($arr)) {
            return ['info'=>'this is not array'];
        }

        $count = count($arr);

        if ($count <= 1) {
            return $arr;
        }

        /**
         * 外层控制循环次数
         */
        for($i=1;$i<$count;$i++) {
            /**
             * 内层比较数组个数，每次比较少一个
             */
            for($j=0;$j<$count-$i;$j++) {
                if ($arr[$j] > $arr[$j+1]) {
                    /**
                     * 变量替换，大的放在临时变量里。前后位置互换
                     */
                    $tmp       = $arr[$j];
                    $arr[$j]   = $arr[$j+1];
                    $arr[$j+1] = $tmp;
                }
            }
        }

        return $arr;
    }

    public static function insertSort($arr)
    {
        if (!is_array($arr)) {
            return ['info'=>'this is not array'];
        }

        $count = count($arr);

        if ($count <= 1) {
            return $arr;
        }

        for ($i=1;$i<$count;$i++) {
            /**
             * 定义一个临时变量,取出数组的第一变量
             */
            $tmp = $arr[$i];

            for($j=$i-1;$j>=0;$j--) {

                /**
                 * 判断临时变量和有序数组的制大小
                 * 临时变量大：跳出本次循环
                 * 临时变量小：互换位置
                 */
                if ($tmp < $arr[$j]) {
                    $arr[$j+1] = $arr[$j];
                    $arr[$j]   = $tmp;
                } else {
                    break;
                }
            }
        }

        return $arr;
    }

    public static function selectSort($arr)
    {
        if (!is_array($arr)) {
            return ['info'=>'this is not array'];
        }

        $count = count($arr);

        if ($count <= 1) {
            return $arr;
        }

        for ($i = 0; $i < $count-1; $i++) {
            $tmp = $i;
            for($j=1 + $i; $j < $count; $j++){
                /**
                 * 如果前一个元素大于后一个元素，那么我们就把后一个元素放到前面，充当最小元素
                 */
                if($arr[$tmp] > $arr[$j]) {
                    $tmp = $j;
                }
            }

            /**
             * 判断当前假设的最小元素是不是上面假设的最小元素
             */

            if ($tmp != $i) {
                $tmpVali     = $arr[$tmp];
                $arr[$tmp]   = $arr[$i];
                $arr[$i]     = $tmpVali;
            }
        }

        return $arr;
    }
}

$arr = [20,15,6,99,100,36,78,65,0];

$arr = SortController::selectSort($arr);

var_dump($arr);