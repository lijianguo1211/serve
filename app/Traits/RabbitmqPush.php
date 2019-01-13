<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/1/11
 * Time: 17:04
 */

namespace App\Traits;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Trait RabbitmqPush
 * 客户端-生产者
 * @package App\Traits
 */
trait RabbitmqPush
{
    /**
     * @var 连接
     */
    private $connectRmq;

    /**
     * @var 通道
     */
    private $channel;

    /**
     * 连接以及绑定
     * @param $options
     */
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
       //绑定交换机和队列
       $this->channel->queue_bind($options['queue'],$options['exchange'],$options['routeKey']);

    }

    /**
     * 发送消息
     * @param $msg
     * @param $options
     */
    public function msgPush($msg, $options)
    {
        $msgBody = new AMQPMessage($msg, ['content_type' => 'json', 'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        //发布消息
        $this->channel->basic_publish($msgBody, $options['exchange'], $options['routeKey']);

        return;
    }

    /**
     * 关闭队列
     */
    public function rmqClose()
    {
        if ($this->connectRmq != null)
        {
            $this->connectRmq->close();
        }

        if ($this->channel != null)
        {
            $this->channel->close();
        }

        $this->connectRmq = null;
        $this->channel = null;

        return;
    }

    /**
     * 外部调用接口
     * @param $msg
     * @param array $options
     * @return bool
     */
    public function rmqPush($msg,$options = [])
    {
        if (count($options) <= 0)
        {
            $options = [
                'queue'   => 'RABBITMQ_QUEUE',
                'exchange' => 'RABBITMQ_EXCHANGE',
                'routeKey' => 'RABBITMQ_ROUTE_KEY'
            ];
        }

        $num = 0;
        $resultRmq = false;
        while ($num < 2)
        {
            try {
                $this->connect($options);
                $this->msgPush($msg, $options);
                $this->rmqClose();
                $resultRmq = true;
            } catch (\Exception $e) {
                sleep(1);
                var_dump($e->getMessage());
            }
            $num++;
        }

        return $resultRmq;
    }
}