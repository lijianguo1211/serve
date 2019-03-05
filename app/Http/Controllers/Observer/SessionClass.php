<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/26
 * Time: 18:49
 */

namespace App\Http\Controllers\Observer;

class SessionClass
{
    public function getSlice($stack,$pipe)
    {
        return function() use ($stack,$pipe)
        {
            return $pipe::handle($stack);
        };
    }

    public function then()
    {
        $pipes = [
            "Jwt",
            "BeforeSession",
            "Session",
            "AfterSession",
            "SessionClass"
        ];

        $firstSlice = function(){
          echo "请求数据路由传递，返回响应";
        };

        //返回单元顺序相反的数组
        $pipe = array_reverse($pipes);

        //第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。
        call_user_func(
            array_reduce($pipes,"getSlice",$firstSlice)
            // 用回调函数迭代地将数组简化为单一的值
        );
    }

    public function index()
    {
        dd(123);
    }
}
