<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/13
 * Time: 10:39
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
    //构造函数   AMQPConnection
    $con = new AMQPConnection($arr);
    if(!$con->connect()) {
        var_dump('连接失败1');
    }

    //先通道声明--传入连接的套接字--构造函数 通过通道连接创建消息通道
    $channel = new AMQPChannel($con);

//交换机声明--传入声明的通道-- 构造函数 通过通道连接交换机
    $exchange = new AMQPExchange($channel);

//设置交换机名
    $exchange->setName(EXEHANGE_NAME);//设置通道名称

//设置连接方式--直连 [直连，主题，广播]
    $exchange->setType(AMQP_EX_TYPE_DIRECT);

//消息持久化
    $exchange->setFlags(AMQP_DURABLE);

//声明
    $exchange->declareExchange();

//声明队列，绑定交换机和路由
    $queue = new AMQPQueue($channel);

//设置队列名字
    $queue->setName(QUEUE_NAME);

//消息持久化
    $queue->setFlags(AMQP_DURABLE);

//声明
    $queue->declareQueue();

//绑定获取数据 参数一：交换机名  参数二：路由
    $queue->bind(EXEHANGE_NAME,ROUTE_KEY_NAME);

//消费，没有数据时，阻塞监听获取数据
    $queue->consume(function($event,$queue){
        $body = $event->getBody();
        var_dump($body);

        $queue->ack($event->getDeliveryTag());
    });

} catch (Exception $e) {
    var_dump('连接失败2');
}




