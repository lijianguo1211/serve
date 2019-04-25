<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/15
 * Time: 15:27
 */

namespace App\Redis;

/**
 * 单利模式，三私一公
 * Class RedisCon
 * @package App\Redis
 */
class RedisCon
{
    private static $instace = null;
    /**
     * 防止外部克隆
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    /**
     * 防止外部实例化
     * RedisCon constructor.
     */
    private function __construct()
    {
        //$host = env('REDIS_HOST','127.0.0.1');
        //$port = env('REDIS_PORT',6379);
        try {
            self::$instace = new \Redis();
            //self::$instace->connect($host,$port);
            self::$instace->connect('127.0.0.1',6379);
        } catch (\Exception $e) {

        }
    }

    /**
     * TODO 外部调用
     * @return null|\Redis
     */
    public static function getInstace()
    {
        if (self::$instace == null) {
            new self;
        }
        return self::$instace;
    }
}
/*
for($i=0;$i<5;$i++){
    $res->hSet('liyi','redis'.$i,mt_rand(100,999)*$i);
}

var_dump($res->hGetAll('liyi'));*/

