### redis 做接口限流的思路

昨天偶然在腾讯课堂听到一位前辈讲接口限流的思路，觉得挺有引导作用的，今天把它记下来，做一下笔记，巩固一下影响。有兴趣的同学
可以一起来探讨哦

一：做笔记之前，首先是环境先装好，我的测试环境是

* `php > 7.0`
* `redis` PHP使用redis,首先安装它的扩展。这个是必要条件
* 介绍一个redis的中文 `api` 文档 [Redis 命令参考](http://doc.redisfans.com/)

二：介绍一下我们一会儿需要用到的`redis`函数

* `incr()` 将 key 中储存的数字值增一。如果 key 不存在，那么 key 的值会先被初始化为 0 ，然后再执行 INCR 操作。

* `expire()` 为给定 key 设置生存时间，当 key 过期时(生存时间为 0 )，它会被自动删除。

方式一： 我们在这里针对的是对IP限流，假设是我们的接口对外提供服务，然后我们不能让它无限制的请求我们的流量，导致别人请求我们的
服务得到回应，这就达不到我们提供服务的初衷。所以，我们在这里假设每10秒，让每一个IP可以请求5次。这里我们先利用`redis`来实现。
我们知道`redis`它是一个单进程的。原子 – Redis的所有操作都是原子性的，同时Redis还支持对几个操作全并后的原子性执行，所以不用
担心高并发引发的问题。同时支持的数据也丰富。

封装一个面向对象的连接

```php
<?php

class Redis
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
```

接下来我们就是具体的实现：

```php
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
        $this->redis->expire($ip,$this->time);
        $num = $this->redis->incr($ip);
        if ($num > $this->maxNumber) {
            exit('请求数据太过于频繁，请稍后再试！！！');
        }
        
        echo '得到数据'.time();
    }
}
```

这种方法最过于简单，但是有一个弊端，达不到我们每10秒请求最多五次的效果。我们首先得到请求的IP。
根据技计数函数`incr()`的特性，我们把它放进去，然后再利用函数`expire()`,给这个IP设定一个过期时间为10秒，在这10秒内，只能
它最多请求五次。

接下来说它的弊端。假设我们在它的第1秒请求1次，在最后的第8秒，连续请求4次。接下来就是最后第二次的过期时间内。又可以请求了。那么
就相当于，我们实际在10秒内早都请求的不止5次，最大可以拿到9次了。这就达不到我们的预期的效果了。

接下来我们在此思路上做一个改进。我们知道`redis`支持的数据结构比较多，其中有一个就是队列。

函数如下：

* `lpush()` 将一个或多个值 value 插入到列表 key 的表头
* `lpop()` 移除并返回列表 key 的头元素。
* `rpush()` 将一个或多个值 value 插入到列表 key 的表尾(最右边)。
* `rpop()` 移除并返回列表 key 的尾元素。
* `lrange()` 回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定。
* `lindex()` 返回列表 key 中，下标为 index 的元素。下标(index)参数 start 和 stop 都以 0 为底，也就是说，以 0 表示列表的第一个元素，
以 1 表示列表的第二个元素，以此类推。你也可以使用负数下标，以 -1 表示列表的最后一个元素， -2 表示列表的倒数第二个元素，以此类推


也就是我我们把来到的请求，都丢进队列里面，加入是从左边丢进去，也就是说，我们最后丢进去的一个请求是在最左边，那么，我们
而每次丢进以IP为队列名的队列时，我们都会放一个时间戳进去，最后我们判断，当前的时间和最后进去的那个时间做计算，当小于10
秒，我们就直接返回服务繁忙，稍后再试。拿到最后一次请求的时间戳使用函数`lrange() | lindex()`都是可以的。

下面时具体伪代码实现:

