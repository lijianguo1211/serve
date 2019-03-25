<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/22
 * Time: 14:01
 */

function isParity($int)
{
    if ($int % 2 == 0) {
        echo $int."--偶数\n";
    } else {
        echo $int."\n";
    }
}

$t1 = microtime(true);
for ($i=0; $i < 10; $i++) {
    isParity($i);
}
$t2 = microtime(true);
echo "\n";
echo ($t2-$t1)*1;
echo "\n";
function isTest($int)
{
    if (($int & 1) == 0) {
        echo $int."偶数\n";
    } else {
        echo $int."奇数\n";
    }
}

$t1 = microtime(true);
for ($i=1; $i <= 10; $i++) {
    isTest($i);
}
$t2 = microtime(true);
echo "\n";
echo ($t2-$t1)*1000;


$a = "许铮的技术成长之路";
$b = $a;
$c = &$a;
$d = $a;
$e = "许铮的技术成长之路1";
$a = $e;
xdebug_debug_zval("a", "b", "c", "d", "e");

/**
 * a = 许铮的技术成长之路
 * b = a = 许铮的技术成长之路
 * c = &a = 许铮的技术成长之路1
 * d = a = 许铮的技术成长之路
 * e = 许铮的技术成长之路1
 * a = e = 许铮的技术成长之路1
 */

/**
 * 1 => 01 & 01 => 01
 * 2 => 10 & 01 => 00
 * 3 => 11 & 01 => 01
 * 4 => 100 & 01 => 000
 * 5 => 101 & 01 => 001
 * 6 => 110 & 01 => 000
 * 7 => 111 & 01 => 001
 * 8 => 1000 & 01 => 0000
 * 9 => 1001 & 01 => 0001
 * 10 => 1010 & 01 => 0000
 */
