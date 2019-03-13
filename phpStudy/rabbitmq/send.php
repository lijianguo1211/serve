<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/13
 * Time: 10:16
 */
//定义交换机
define('EXEHANGE_NAME','RMQ_EN');

//定义路由
define('ROUTE_KEY_NAME','RMQ_RKN');

//定义队列
define('QUEUE_NAME','RMQ_QN');

try {
    $arr = [
        'host'     => '127.0.0.1',
        'port'     => 5672,
        'user'     => 'guest',
        'password' => 'guest',
        'vhost'    => '/',
    ];
    //构造函数
    $con = new AMQPConnection($arr);
    if(!$con->connect()) {
        var_dump('连接失败1');
    }
    //先通道声明--传入连接的套接字--构造函数 通过通道连接创建消息通道
    $channel = new AMQPChannel($con);

    //交换机声明--传入声明的通道-- 构造函数 通过通道连接交换机
    $exchange = new AMQPExchange($channel);

    //设置交换机名
    $exchange->setName(EXEHANGE_NAME);

    $exchange->setType(AMQP_EX_TYPE_DIRECT);

    //发送消息 参数一：要发送的消息内容，参数二：路由

    for ($i = 0; $i < 20; $i++) {
        $message = date('Y-m-d H:i:s',time()).'--'.mt_rand(100,1000)*$i.'---消息'.$i;
        $exchange->publish($message,ROUTE_KEY_NAME);
    }
} catch (Exception $e) {
    var_dump('连接失败');
}





