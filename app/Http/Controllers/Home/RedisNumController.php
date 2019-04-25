<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-25
 * Time: 22:16
 */

namespace App\Http\Controllers\Home;

use App\Redis\RedisCon;
use Illuminate\Http\Request;

class RedisNumController
{
    private $redis;

    private $maxNumber = 5;

    private $param;

    private $time = 10;

    public function __construct(Request $request)
    {
       $this->redis = RedisCon::getInstace();
       $this->param = $request;
    }

    /**
     * 判断
     */
    public function index()
    {
        $ip = $this->param->getClientIp();

        $num = $this->redis->incr($ip);
        if ($num > $this->maxNumber) {
            exit('请求数据太过于频繁，请稍后再试！！！');
        }
        $this->redis->expire($ip,$this->time);
        echo '得到数据'.time();
    }

    public function test()
    {
        $ip = $this->param->getClientIp();

        $this->redis->lPush($ip,time());
        $num = $this->redis->lrange($ip,0,0);
        if ((time()-$num[0]) < 10) {

            $this->redis->lPush($ip,time());
            echo 'time:'.time();
        }
        exit('请求数据太过于频繁，请稍后再试！！！');
    }
}