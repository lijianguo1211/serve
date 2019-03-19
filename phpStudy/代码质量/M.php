<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/18
 * Time: 16:49
 */
/*$arr[3] = 'ce';
$arr[2] = 'shi';
$arr[1] = 'oo';

foreach ($arr as $k => $v) {
    echo $v . "\n";
}

for ($i=0;$i<=count($arr);$i++) {
    echo $arr[$i]."\n";
}

$arr = array(1,2,3,4,5,);
$arr[] = &$arr;

var_export($arr);*/



/*function getDiffVersion()
{
    $ip_1 = '192.168.60.1';

    $ip_2 = '192.168.60.1';

    $ip_arr_1 = explode('.',$ip_1);

    $ip_arr_2 = explode('.',$ip_2);

//$diff = array_diff($ip_arr_1,$ip_arr_2);
    $count1 = count($ip_arr_1);
    $count2 = count($ip_arr_2);

    if ($count1 === $count2) {
        $count = $count1;
    }

    $count = $count1 === $count2 ? $count1 : 4;

    for($i=0; $i<$count; $i++) {
        if ($ip_arr_1[$i] == $ip_arr_2[$i]) {
            continue;
        }
        echo 'error';
        break;
    }
    echo 'SUCCESS';
}*/

/*$str = 'qwertyuioplkjhghfdssazxcxcvbnm';

echo "\n";

$t3 = microtime(true);
for ($i=0; $i<strlen($str); $i++) {

}

$t4 = microtime(true);


//echo ($t4 - $t3);
echo "\n";

$t1 = microtime(true);
for ($i=0; $i<strlen($str); $i++) {

}

$t2 = microtime(true);*/

//echo ($t2 - $t1);

//**********************************************************************************************************************

/*function test($s)
{
    if(empty($s)){
        return 0;
    }
    $arrStr = str_split($s);
    $num = count($arrStr);
    $option = array();
    $sum = 0;

    for($i = 0; $i < $num; $i++){
        if(in_array($arrStr[$i] ,$option)){
            $flag = count($option);
            foreach($option as $key => $value){
                if($value == $arrStr[$i]){
                    unset($option[$key]);
                    break;
                }
                unset($option[$key]);
            }
            $sum = ($sum < $flag) ? $flag : $sum;
        }
        $option[] = $arrStr[$i];
    }
    $outPut = count($option) > $sum ? count($option) : $sum;
    return $outPut;
}*/


/**
 * 两个有序数组，合并数组，得到中位数
 * @param $nums1
 * @param $nums2
 */
/*function findMedianSortedArrays($nums1, $nums2) {

        $newArr = array_merge($nums1,$nums2);
        $newArr = qSort($newArr);
        sort($newArr);
        $count = count($newArr);
        if ($count % 2 == 0) {
            $a1 = $newArr[$count/2];
            $a2 = $newArr[($count/2)-1];
            return ($a1+$a2)/2;
        } else {
          return $newArr[($count+1)/2-1];
        }

}

function qSort($arr)
{
    if (!is_array($arr)) {
        return ['error'=>'非数组'];
    }

    $count = count($arr);
    if ($count <=1) {
        return $arr;
    }

    $leftArr = $rightArr = [];
    $baseNum = $arr[0];
    for ($i=1; $i<$count; $i++) {
        if ($baseNum > $arr[$i]) {
            $leftArr[] = $arr[$i];
        } else {
            $rightArr[] = $arr[$i];
        }
    }
    $leftArr = qSort($leftArr);
    $rightArr = qSort($rightArr);
    return array_merge($leftArr,(array)$baseNum,$rightArr);
}


$nums1 = [1,3];
$nums2 = [2];
var_dump(findMedianSortedArrays($nums1, $nums2));*/


/**
 * 回文字符串
 * @param $s
 * @return bool|string
 */
function longestPalindrome($s) {

    //得到字符串长度
    $len = strlen($s);
    //判断字符串长度是否为小于2，返回字符串本身
    if($len < 2) return $s;
    $dp = [];                       //初始化动态规划dp数组，dp[i][j]表示从j到i的字符串是否为回文串
    $right = $left = 0;             //初始化最长的最优节点
    for($i=0;$i<$len;++$i){
        $dp[$i][$i] = true;         //todo 1>边界条件：只有一个元素的时候肯定为true
        for($j=$i-1;$j>=0;--$j){    //遍历到第i个元素，再倒退判断是否为回文串
            //头i尾j两个元素相等，且dp[i-1][j+1]是回文串，即dp[i][j]也是回文串
            //todo 2>特殊情况,“bb”,此时dp[i-1][j+1]=dp[j][i]此时数组不成立，不存在截取的反向字符串
            $dp[$i][$j] = $s[$i] == $s[$j] && ($i-$j==1 || $dp[$i-1][$j+1]);
            if($dp[$i][$j] && ($i-$j)>($right-$left)){
                $right = $i;        //todo 3>截取的字符串的长度大于之前求得的左右长度，则取的左右下标点
                $left = $j;
            }
        }
    }
    return substr($s,$left,$right-$left+1); //截取字符串
}

var_dump(longestPalindrome('abcbaasdfsdfdfgdfg'));
