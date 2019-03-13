### rabbitmq 消息中间件

php使用rabbitmq，如果不想使用别人集成的开发包，那就需要自己鼓捣

1. 首先说使用集成开发包的，PHP的扩展需要安装`bcmath`这个数学相关的扩展。然后利用`composer`安装开发包.

```json
{
    "require": {
        "php-amqplib/php-amqplib": ">=2.6.1"
    }
}
```

运行`composer.phar install`就可以了

2. 使用PHP的扩展`amqp`,简单说一下安装

2.1 在`http://pecl.php.net/package/amqp`这里，可以看到各个版本的安装包，点击下载选中	`amqp-1.9.4.tgz`下载

2.2 上传到服务器

2.3 解压 `tar -xf amqp-1.9.4.tgz`

2.4 查找到自己服务器上`phpize  php-config` 的位置

2.5 进入amqp-1.9.4,加压后的文件

2.6 准备编译 `/usr/bin/phpize`

2.7 `./configure --with-php-config=/usr/bin/php-config`

2.8 `make && make install` 一般在这一步是最容易出错的，我这里出错给出的提示是缺少`rabbitmq-c`这个依赖，直接`yum`查找
`yum search rabbitmq`。网上很多是编译安装，没必要的，如果`yum`安装不了，再去编译安装。搜索出来的应该会有四个，找到适合自己服务器的，一般要安装的
就是`rabbitmq-devl`这种版本的

2.9 重新[2.6--2.8]的操作，最后可以看到编译成功，有两个东西需要注意，一个是编译完成之后，我们的扩展存放的位置 `/usr/lib64/php/modules`.应该都是
这个位置。第二个是让我们运行 `make test`命令

3.0 这时如果都没有问题，那么我们这个时候需要给我们的配置文件添加上extension=amqp.so

3.1 查找配置文件位置，一般都是在`/etc/php.d`这个里面，我们创建一个`touch amqp.ini`,然后把 `extension=amqp.so`添加进去。

3.2 重启PHP-FPM，nginx `service php-fpm restart | service nginx restart`

3.3 查看PHP的扩展 `php -m`

3.4 查看配置文件 `php -ini | grep amqp`

* 消息生产者

```php
<?php

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


?>
```


* 消息消费者

```php
<?php
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
?>
```

* 我们可以在服务器上多开几个终端，运行多个消费者，运行一个生产者。就可以看到我们消费者之间消费的消息是平均消费的，这是设置的参数不同导致的，不能一慨而论。
