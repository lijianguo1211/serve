<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/1/13
 * Time: 16:07
 */

namespace App\Traits;


use PhpAmqpLib\Connection\AMQPStreamConnection;

trait RabbitmqPull
{
    /**
     * @var
     */
    private $connectRmq;

    /**
     * @var
     */
    private $channel;


    public function connect($options)
    {
        $host = env('RABBITMQ_HOST','127.0.0.1');
        $port = env('RABBITMQ_PORT','5672');
        $user = env('RABBITMQ_USER','guest');
        $pass = env('RABBITMQ_PASS','guest');
        $vhost = env('RABBITMQ_VHOST','/');

        //创建连接
        $this->connectRmq = new AMQPStreamConnection($host,$port,$user,$pass,$vhost);
        //创建消息通道
        $this->channel = $this->connectRmq->channel();
        //客户端声明一个交换机 [exchange]  默认精准推送，不检测同名交换机，持久化，不自动删除交换机
        $this->channel->exchange_declare($options['exchange'],'direct',false,true,false);
        //客户端声明一个队列 [queue] 不检测同名队列，持久化，不允许其他队列访问，不自动删除队列
        $this->channel->queue_declare($options['queue'],false,true,false,false);
    }

    public function getMessage()
    {
        $options = [
            'queue'   => 'RABBITMQ_QUEUE',
            'exchange' => 'RABBITMQ_EXCHANGE',
            'routeKey' => 'RABBITMQ_ROUTE_KEY'
        ];

        try {
            $callback = function($msg)  {
                echo  '[x] Received'.$msg->body."\n ";
            };
            $this->connect($options);
            $objMessage = $this->channel->basic_get($options['queue']);
            $this->channel->basic_consume($options['queue'], '', false, true, false, false, $callback);
            while(count($this->channel->callbacks)) {
                $this->channel->wait();
            }
            if ($objMessage) {
                // 回复确认信息
                $this->channel->basic_ack($objMessage->delivery_info['delivery_tag']);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
        return $objMessage;
    }
}