<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

class RedisController extends Controller
{
    /*
     * redis 测试；设置redis set();读取redis get();
     */
    public function index()
    {
        //$redis = new Redis();
        Redis::set('name', 'Taylor');
        echo Redis::get('name');
        echo Redis::get('test');
        $redis = Redis::connection();
        dd($redis);
    }

    public function test()
    {
        /*
         * 管道命令
           当你需要在一次操作中发送多个命令到服务器的时候应该使用管道，
           pipeline 方法接收一个参数：接收 Redis 实例的闭包。
           你可以将所有 Redis 命令发送到这个 Redis 实例，然后这些命令会在一次操作中被执行：
         */
        Redis::pipeline(function ($pipe) {
            for ($i = 0; $i < 1000; $i++) {
                $pipe->set("key:$i", $i);
            }
        });
    }

    public function send()
    {
        Route::get('publish', function () {
            // 路由逻辑...
            Redis::publish('test-channel', json_encode(['foo' => 'bar']));
        });
    }
}
