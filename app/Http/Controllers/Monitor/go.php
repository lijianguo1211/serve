<?php
/**
 * swoole高版本携程支持
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/1/24
 * Time: 10:06
 */

$chan = new chan(2);

go(function () use ($chan) {
    //Co::sleep(2);
    $arr = 123456;
    $chan->push($arr);
});

go(function () use ($chan) {
    //Co::sleep(5);
    $arr = 789123;
    $chan->push($arr);
});


/**
 * ->pop() 这个方法必须在协程中调用
 */
go(function() use ($chan) {
    for ($i=0; $i<2; $i++) {
        var_dump($chan->pop());
    }
});

