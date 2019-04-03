### Elasticsearch-PHP 学习了解（一）

* Elasticsearch—PHP [的github地址](https://github.com/elastic/elasticsearch-php)

首先是安装，我的环境是在windows10上测试，PHP的版本是7.0；所以我直接安装的的Elasticsearch—PHP也是大于等于6.0的。PHP的框架也是laravel5.5。
直接在我们的`composer.json`中添加:

```json
        {
            "require": {
                "elasticsearch/elasticsearch": "~6.0"
            }
        }
```

这个在说明文档都有，然后运行`php composer.phar update | install`。坐享其成就可以了。最后得到的就是下面的这个样子：

![vendor-elasticsearch](1.png)

以上是属于安装PHP的操作`API`,我们还需要下载安装`Elasticsearch`服务端。

我在windows上测试，[Elasticsearch-windows](https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.7.0.zip)

前提是本地安装了java环境，java的安装就不在赘述了。`Elasticsearch`就是一个zip包，下载完成之后，在你喜欢的地方创建一个`Elasticsearch`文件，解压。
可以在你的环境变量里加入`path = F:\Elasticsearch\elasticsearch-6.7.0\bin`。然后打开`cmd`,输入`elasticsearch.bat`回车。打开浏览器，输入
`localhost:9200`。可以看到浏览器的输出：

```json
{
  "name" : "OgXEkyd",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "gNbzzuQ1Qd-X9zQidpkpAw",
  "version" : {
    "number" : "6.7.0",
    "build_flavor" : "default",
    "build_type" : "zip",
    "build_hash" : "8453f77",
    "build_date" : "2019-03-21T15:32:29.844721Z",
    "build_snapshot" : false,
    "lucene_version" : "7.7.0",
    "minimum_wire_compatibility_version" : "5.6.0",
    "minimum_index_compatibility_version" : "5.0.0"
  },
  "tagline" : "You Know, for Search"
}
```

代表启动`elasticsearch`成功。

************************************************************************************************************************

#### PHP操作elasticsearch

* 基本操作

创建一个`ElasticsearchController.php`文件，引入`use Elasticsearch\ClientBuilder;`

```php
<?php
namespace App\Http\Controllers\Api;

use Elasticsearch\ClientBuilder;

class ElasticsearchController
{
    private $client = null;
    
    public function __construct() 
    {
        $this->client = ClientBuilder::create()->setHosts(['localhost:9200'])->build();
    }
}
```

与`redis mysql psql`一样，想要操作它，第一步是连接它。打印连接信息：

```php
Client {#472 ▼
  +transport: Transport {#470 ▶}
  #params: null
  #indices: IndicesNamespace {#473 ▶}
  #cluster: ClusterNamespace {#474 ▶}
  #nodes: NodesNamespace {#475 ▶}
  #snapshot: SnapshotNamespace {#476 ▶}
  #cat: CatNamespace {#477 ▶}
  #ingest: IngestNamespace {#478 ▶}
  #tasks: TasksNamespace {#479 ▶}
  #remote: RemoteNamespace {#480 ▶}
  #endpoints: Closure {#471 ▶}
  #registeredNamespaces: []
}
```

1.) 创建一个文档

```php
    public function createDocument()
    {
        $params = [
            'index' => 'laravel',//数据库
            'type' => 'users',//数据表
            'id' => 'id',//主键
            'body' => ['testField' => 'abc']//每条记录
        ];

        $response = $this->client->index($params);
        dd($response);
    }
```

在这里，`param`这个数组里面，我们有四组`key=>value`

* `index` 这个就好像我们`mysql`里面的数据库
* `type`  这个就代表数据库表
* `id`    这个就代表数据库表的主键
* `body`  这个就代表数据库表里面的每一条记录

以上大概是那个意思。我觉得这样类比可能好理解一点。可能会有不对或比较片面

结果：

```php
array:8 [▼
  "_index" => "laravel"
  "_type" => "users"
  "_id" => "id"
  "_version" => 1
  "result" => "created"
  "_shards" => array:3 [▼
    "total" => 2
    "successful" => 1
    "failed" => 0
  ]
  "_seq_no" => 0
  "_primary_term" => 1
]
```

2.) 获取一个文档

```php
public function getDocument()
    {
        $param = [
            'index' => 'laravel',
            'type'  => 'users',
            'id'    => 'id'
        ];

        $responce = $this->client->get($param);

        dd($responce);
    }
```

结果：

```php
array:8 [▼
  "_index" => "laravel"
  "_type" => "users"
  "_id" => "id"
  "_version" => 1
  "_seq_no" => 0
  "_primary_term" => 1
  "found" => true
  "_source" => array:1 [▼
    "testField" => "abc"
  ]
]
```

3.) 搜索一个文档

```php
 public function searchDocument()
    {
        $param = [
            'index'  => 'laravel',
            'type'   => 'users',
            'body'   => [
                'query'  => [
                    'match' => [
                        'testField' => 'abc'
                    ]
                ]
            ]
        ];

        $responce = $this->client->search($param);

        dd($responce);
    }
```

结果：

```php
array:4 [▼
  "took" => 8
  "timed_out" => false
  "_shards" => array:4 [▼
    "total" => 5
    "successful" => 5
    "skipped" => 0
    "failed" => 0
  ]
  "hits" => array:3 [▼
    "total" => 1
    "max_score" => 0.2876821
    "hits" => array:1 [▼
      0 => array:5 [▼
        "_index" => "laravel"
        "_type" => "users"
        "_id" => "id"
        "_score" => 0.2876821
        "_source" => array:1 [▼
          "testField" => "abc"
        ]
      ]
    ]
  ]
]
```

4.) 删除一个文档

```php
public function deleteDocument()
    {
        $param = [
            'index' => 'laravel',
            'type'  => 'users',
            'id'    => 'id',
        ];

        $responce = $this->client->delete($param);

        dd($responce);
    }
```

结果：

```php
array:8 [▼
  "_index" => "laravel"
  "_type" => "users"
  "_id" => "id"
  "_version" => 2
  "result" => "deleted"
  "_shards" => array:3 [▼
    "total" => 2
    "successful" => 1
    "failed" => 0
  ]
  "_seq_no" => 1
  "_primary_term" => 1
]
```

5.) 删除一个索引

```php
 public function deleteIndex()
    {
        $deleteParam = [
            'index' => 'laravel'
        ];

        $responce = $this->client->indices()->delete($deleteParam);

        dump($responce);
    }
```

结果：

```php
array:1 [▼
  "acknowledged" => true
]
```

6.) 创建一个索引

```php
public function createIndex()
    {
        $param = [
            'index' => 'my_index',
            'body'  => [
                'settings' => [
                    'number_of_shards' => 2,
                    'number_of_replicas' => 0
                ]
            ]
        ];

        $responce = $this->client->indices()->create($param);

        dd($responce);
    }
```

结果：

```php
array:3 [▼
  "acknowledged" => true
  "shards_acknowledged" => true
  "index" => "my_index"
]
```

以上属于简单尝试，如果想运用到项目中去，远远不够。

************************************************************************************************************************

#### `elasticsearch`常用的配置

* 连接时，配置连接地址和端口的方法，看到这个方法，它就是一个简单的赋值操作呢：

```php
    public function setHosts($hosts)
    {
        $this->hosts = $hosts;

        return $this;
    }
```

这个方法属于`class ClientBuilder{}`这个类，看到这个方法的返回，我们就知道，它是支持链式调用的；也就是说，我们可以

```php
ClientBuilder::create()->setHosts(['host'=>'localhost:9200'])->build();
```

还可以：

```php
$client = ClientBuilder::create();
$client->setHosts();
$client->build();
```

`setHosts()`方法接受一个数组。如果我们不设置的话，它会有一个默认值方法：

```php
    private function getDefaultHost()
    {
        return ['localhost:9200'];
    }
```

也就是最后一个调用`build()`方法的时候，会有一步检测,如果我们没有调用这个`setHosts()`方法。那么在这儿判断的时候，就会去`getDefaultHost()`方法
拿取默认值。

```php
public function build()
{
    if (is_null($this->hosts)) {
            $this->hosts = $this->getDefaultHost();
    }
}
```

* http 认证，这个也是要配置在`setHosts()`方法参数的数组里的

```php
$host = [
    'http://user:pass@localhost:9200'
];
```

就是在我们的ip和端口前面需要加上用户名和密码。

* 设置重连次数 `setRetries(2)`,它也是一个赋值操作，同样也是可以链式操作的。

```php
public function setRetries($retries)
    {
        $this->retries = $retries;

        return $this;
    }
```

同样的，我们也不需要担心，如果我们不设置的话，系统也会检测的

```php
private function buildTransport()
{
$connections = $this->buildConnectionsFromHosts($this->hosts);

        if (is_string($this->connectionPool)) {
            $this->connectionPool = new $this->connectionPool(
                $connections,
                $this->selector,
                $this->connectionFactory,
                $this->connectionPoolArgs
            );
        } elseif (is_null($this->connectionPool)) {
            $this->connectionPool = new StaticNoPingConnectionPool(
                $connections,
                $this->selector,
                $this->connectionFactory,
                $this->connectionPoolArgs
            );
        }

        //系统检测是否设置了重连次数
        if (is_null($this->retries)) {
            $this->retries = count($connections);
        }

        if (is_null($this->transport)) {
            $this->transport = new Transport($this->retries, $this->sniffOnStart, $this->connectionPool, $this->logger);
        }
}
```

如果没有设置，会调用`buildConnectionsFromHosts($this->hosts);`这个方法

```php
private function buildConnectionsFromHosts($hosts)
{
if (is_array($hosts) === false) {
            $this->logger->error("Hosts parameter must be an array of strings, or an array of Connection hashes.");
            throw new InvalidArgumentException('Hosts parameter must be an array of strings, or an array of Connection hashes.');
        }

        $connections = [];
        foreach ($hosts as $host) {
            if (is_string($host)) {
                $host = $this->prependMissingScheme($host);
                $host = $this->extractURIParts($host);
            } elseif (is_array($host)) {
                $host = $this->normalizeExtendedHost($host);
            } else {
                $this->logger->error("Could not parse host: ".print_r($host, true));
                throw new RuntimeException("Could not parse host: ".print_r($host, true));
            }
            $connections[] = $this->connectionFactory->create($host);
        }

        return $connections;
}
```

这个方法里根据，我们`setHosts()`这个方法里面的参数，来做相对应节点的创建。最后返回一个数组。然后统计`count()`这个数组，来设置对应的默认值。还可以
在连接时，做相对应的链接异常处理

```php
$client = ClientBuilder::create()->setHosts(['localhost:9200'])->setRetries(0)->build();

try {
    $param = [];
    $client->search($param);
} catch(Elasticsearch\Common\Exceptions\TransportException $e) {
    $previous = $e->getPrevious();
    if ($previous instanceof 'Elasticsearch\Common\Exceptions\MaxRetriesException') {
            echo "Max retries!";
        }
}
```

* 开启日志，注入客户端。在`laravel`里面已经有`Monolog`，就不需要再安装了。主要的方法`setLogger()`使用：

```php
$logger = ClientBuilder::defaultLogger(__DIR__.'/es/'.date('Y-m-d',time()).'.log',Logger::INFO);
```

```php
   public static function defaultLogger($path, $level = Logger::WARNING)
    {
        $log       = new Logger('log');
        $handler   = new StreamHandler($path, $level);
        $log->pushHandler($handler);

        return $log;
    }
```

很明显，`defaultLogger()`这是一个静态方法，有两个参数：

1.) `$path` 这是你需要自己设置的`Elasticsearch`日志存储路经
2.) `$level` 这个就是日志级别。这是看你自己的需要了，我测试，我使用的是`Logger::INFO`

然后在我们创建文档的方法里，添加一行这样的代码：

```php
\Log::info($response);
```

然后你再去看看你的当前工作目录，发现肯定多了一个es目录，并且下面有一个以当前日期为记录的日志文件。

* 配置`http headler`,主要方法`setHeadler()`

```php
$defaultHandler = ClientBuilder::defaultHandler();
$singleHandler  = ClientBuilder::singleHandler();
$multiHandler   = ClientBuilder::multiHandler();

ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->setRetries(2)
            ->setLogger($logger)
            ->setHandler($defaultHandler)
            ->build();
```

```php
public static function defaultHandler($multiParams = [], $singleParams = [])
    {
        $future = null;
        //extension_loaded()检查curl扩展是否已经加载
        if (extension_loaded('curl')) {
        //curl_multi_init() 返回一个新cURL批处理句柄 [允许并行地处理批处理cURL句柄] return 成功时返回一个cURL批处理句柄，失败时返回FALSE。
        //array_merge 数组合并
            $config = array_merge([ 'mh' => curl_multi_init() ], $multiParams);
            //判断curl_reset()方法是否存在
            //curl_reset()  重置一个 libcurl 会话句柄的所有的选项. 该函数将给定的 cURL 句柄所有选项重新设置为默认值。
            if (function_exists('curl_reset')) {
            //这就是具体的实现是同步还是异步并行请求
                $default = new CurlHandler($singleParams);
                $future = new CurlMultiHandler($config);
            } else {
                $default = new CurlMultiHandler($config);
            }
        } else {
            throw new \RuntimeException('Elasticsearch-PHP requires cURL, or a custom HTTP handler.');
        }

        return $future ? Middleware::wrapFuture($default, $future) : $default;
    }
```

>在所有的情况下都推荐使用默认的 handler。这不仅可以以同步模式快速发送请求，而且也保留了异步模式来实现并行请求。 如果你觉得你永远不会用到 future 模
式，你可以考虑用 singleHandler ，这样会间接节省一些性能

所以，对于平常我们使用的话，可以根据自己的情况来调整，但是只要不是特别大，特别忙，基本默认值就可以了

* 设置连接池 `setConnectionPool()`,方法具体实现：

>连接池是用来管理集群的连接

```php
public function setConnectionPool($connectionPool, array $args = [])
    {
        if (is_string($connectionPool)) {
            $this->connectionPool = $connectionPool;
            $this->connectionPoolArgs = $args;
        } elseif (is_object($connectionPool)) {
            $this->connectionPool = $connectionPool;
        } else {
            throw new InvalidArgumentException("Serializer must be a class path or instantiated object extending AbstractConnectionPool");
        }

        return $this;
    }
```

```php
$logger = ClientBuilder::defaultLogger(__DIR__.'/es/'.date('Y-m-d',time()).'.log',Logger::INFO);

        $defaultHandler = ClientBuilder::defaultHandler();
        $singleHandler  = ClientBuilder::singleHandler();
        $multiHandler   = ClientBuilder::multiHandler();

        $connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool';

        $this->client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->setRetries(2)
            ->setLogger($logger)
            ->setHandler($defaultHandler)
            ->setConnectionPool($connectionPool)
            ->build();
```

从这里我们看到，测试时，我们传入的只有一个参数，而且是一个字符串。但是它还可以传递对象。在这里，我们看到

```php
$this->connectionPool = $connectionPool;
$this->connectionPoolArgs = $args;
```

下面是几种不同的连接池：想了解的可以点击
1.)[staticNoPingConnectionPool（默认）](https://www.elastic.co/guide/cn/elasticsearch/php/current/_connection_pool.html#_staticnopingconnectionpool_%E9%BB%98%E8%AE%A4);

2.)[StaticConnectionPool](https://www.elastic.co/guide/cn/elasticsearch/php/current/_connection_pool.html#_staticconnectionpool);

3.)[SimpleConnectionPool](https://www.elastic.co/guide/cn/elasticsearch/php/current/_connection_pool.html#_simpleconnectionpool);

4.)[SniffingConnectionPool](https://www.elastic.co/guide/cn/elasticsearch/php/current/_connection_pool.html#_sniffingconnectionpool);

* 设置选择器 `setSelector()`

>选择器则是用来确定下一个 API 请求要用哪个连接

```php
        $logger = ClientBuilder::defaultLogger(__DIR__.'/es/'.date('Y-m-d',time()).'.log',Logger::INFO);

        $defaultHandler = ClientBuilder::defaultHandler();
        $singleHandler  = ClientBuilder::singleHandler();
        $multiHandler   = ClientBuilder::multiHandler();

        $connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool';

        $selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector';

        $this->client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->setRetries(2)
            ->setLogger($logger)
            ->setHandler($defaultHandler)
            ->setConnectionPool($connectionPool)
            ->setSelector($selector)
            ->build();
    }
```

具体实现：

```php
    $selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector';

    public function setSelector($selector)
    {
        $this->parseStringOrObject($selector, $this->selector, 'SelectorInterface');

        return $this;
    }
    
    private function parseStringOrObject($arg, &$destination, $interface)
    {
        if (is_string($arg)) {
            $destination = new $arg;
        } elseif (is_object($arg)) {
            $destination = $arg;
        } else {
            throw new InvalidArgumentException("Serializer must be a class path or instantiated object implementing $interface");
        }
    }    
```

这里就是直接，实例化我们设置的选择器

* 设置序列化器 `setSerializer()`

> 序列化器是指把 PHP 数组序列化为 JSON 数据。当然 Elasticsearch 返回的 JSON 数据也会反序列化为 PHP 数组

```php
        $logger = ClientBuilder::defaultLogger(__DIR__.'/es/'.date('Y-m-d',time()).'.log',Logger::INFO);

        $defaultHandler = ClientBuilder::defaultHandler();
        $singleHandler  = ClientBuilder::singleHandler();
        $multiHandler   = ClientBuilder::multiHandler();

        $connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool';

        $selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector';

        $serializer = '\Elasticsearch\Serializers\SmartSerializer';

        $this->client = ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->setRetries(2)
            ->setLogger($logger)
            ->setHandler($defaultHandler)
            ->setConnectionPool($connectionPool)
            ->setSelector($selector)
            ->setSerializer($serializer)
            ->build();
```

具体实现：其实就是实例化我们设置的序列化器

```php
    $serializer = '\Elasticsearch\Serializers\SmartSerializer';

    public function setSerializer($serializer)
    {
        $this->parseStringOrObject($serializer, $this->serializer, 'SerializerInterface');

        return $this;
    }
    
    private function parseStringOrObject($arg, &$destination, $interface)
    {
        if (is_string($arg)) {
            $destination = new $arg;
        } elseif (is_object($arg)) {
            $destination = $arg;
        } else {
            throw new InvalidArgumentException("Serializer must be a class path or instantiated object implementing $interface");
        }
    }    
```

************************************************************************************************************************

#### 根据需求配置具体的参数

* 拒绝异常报错。

比如我们之前创建的文档是：
```php
$params = [
            'index' => 'laravel',//数据库
            'type' => 'users',//数据表
            'id' => 'id',//主键
            'body' => ['testField' => 'abc']//每条记录
        ];
```

现在我们查询一个不存在的：

```php
$param = [
            'index' => 'laravels',
            'type'  => 'users',
            'id'    => 'id'
        ];

        $response = $this->client->get($param);
        \Log::info($response);
        dd($response);
```

就会得到一个[404]错误：

```json
{"error":{"root_cause":[{"type":"index_not_found_exception","reason":"no such index","resource.type":"index_expression","resource.id":"laravels","index_uuid":"_na_","index":"laravels"}],"type":"index_not_found_exception","reason":"no such index","resource.type":"index_expression","resource.id":"laravels","index_uuid":"_na_","index":"laravels"},"status":404}
```

如果想避免，可以这样设置：

```php
$param = [
            'index' => 'laravels',
            'type'  => 'users',
            'id'    => 'id',
            'client' => [
                'ignore' => 404
            ]
        ];
```
最后再去请求:可以得到正常展示，不会直接让程序奔溃
```php
array:2 [▼
  "error" => array:7 [▼
    "root_cause" => array:1 [▶]
    "type" => "index_not_found_exception"
    "reason" => "no such index"
    "resource.type" => "index_expression"
    "resource.id" => "laravels"
    "index_uuid" => "_na_"
    "index" => "laravels"
  ]
  "status" => 404
]
```

同时，上面的数组配置，不仅可以忽略http的404，我们可以配置成数组的形式，忽略更多的

```php
$param = [
    'client' => [
        'ignore' => [
            400,
            401,
            402,
            403,
            404,
            500
        ]
    ]
];
```

* 自定义查询参数，需要参数`custom`

```php
$param = [
    'client':[
        'ignore' => [],
        'custom' => [
            'publicToken' => 123456,
            'otherToken'  => 'admin'
        ],
    ]
];
```

* 返回详细输出 `'verbose' => true`

```php
        $param = [
            'index' => 'laravel',
            'type'  => 'users',
            'id'    => 'id',
            'client' => [
                'ignore' => 404,
                'custom' => [
                    'publicToken' => 123456,
                    'otherToken'  => 'admin'
                ],
                'verbose' => true
            ]
        ];

        $response = $this->client->get($param);
        \Log::info($response);
        dd($response);
```

最后输出：

```php
array:8 [▼
  "transfer_stats" => array:28 [▼
    "url" => "http://localhost:9200/laravel/users/id"
    "content_type" => "application/json; charset=UTF-8"
    "http_code" => 200
    "header_size" => 87
    "request_size" => 114
    "filetime" => -1
    "ssl_verify_result" => 0
    "redirect_count" => 0
    "total_time" => 0.015
    "namelookup_time" => 1.0E-6
    "connect_time" => 1.0E-6
    "pretransfer_time" => 1.0E-6
    "size_upload" => 0.0
    "size_download" => 133.0
    "speed_download" => 133.0
    "speed_upload" => 0.0
    "download_content_length" => 133.0
    "upload_content_length" => -1.0
    "starttransfer_time" => 0.015
    "redirect_time" => 0.0
    "redirect_url" => ""
    "primary_ip" => "::1"
    "certinfo" => []
    "primary_port" => 9200
    "local_ip" => "::1"
    "local_port" => 54304
    "error" => ""
    "errno" => 0
  ]
  "curl" => array:2 [▼
    "error" => ""
    "errno" => 0
  ]
  "effective_url" => "http://localhost:9200/laravel/users/id"
  "headers" => array:2 [▼
    "content-type" => array:1 [▼
      0 => "application/json; charset=UTF-8"
    ]
    "content-length" => array:1 [▼
      0 => "133"
    ]
  ]
  "version" => "1.1"
  "status" => 200
  "reason" => "OK"
  "body" => array:8 [▼
    "_index" => "laravel"
    "_type" => "users"
    "_id" => "id"
    "_version" => 5
    "_seq_no" => 4
    "_primary_term" => 1
    "found" => true
    "_source" => array:1 [▼
      "testField" => "abc"
    ]
  ]
]
```

* `curl`超时设置 `'timeout' => 10,'connect_timeout' => 10`

```php
        $param = [
            'index' => 'laravel',
            'type'  => 'users',
            'id'    => 'id',
            'client' => [
                'timeout' => 10,
                'connect_timeout' => 10
            ]
        ];
```

* 开启异步模式，客户端支持异步方式批量发送请求。通过 client 选项的 future 参数可以开启（HTTP handler 要支持异步模式）：Future 模式有两个参数可选： true 或 lazy 

```php
$param = [
    'client' => [
        'future' => 'lazy'
    ],
];
```

得到结果：

```php
FutureArray {#589 ▼
  -waitfn: array:2 [▼
    0 => FutureArray {#580 ▶}
    1 => "wait"
  ]
  -cancelfn: array:2 [▼
    0 => FutureArray {#580 ▶}
    1 => "cancel"
  ]
  -wrappedPromise: Promise {#590 ▼
    -canceller: null
    -result: null
    -handlers: array:1 [▼
      0 => Closure {#605 ▶}
    ]
    -progressHandlers: & array:1 [▼
      0 => Closure {#604 ▶}
    ]
    -requiredCancelRequests: 0
    -cancelRequests: 0
  }
  -error: null
  -result: null
  -isRealized: false
}
```

* `ssl`加密

```php
$param = [
    'client' => [
        'verify' => '证书路径'
    ]
];
```

* 得到索引 `getMapping()`

```php
$this->client->indices()->getMapping();

//********************************************//

array:2 [▼
  "laravel" => array:1 [▼
    "mappings" => array:1 [▶]
  ]
  "my_index" => array:1 [▼
    "mappings" => []
  ]
]
```

* 修改索引映射 `putMapping()`





* 搜索参数设置

```php
<?php
$param = [
    'index' => '库',
    'type'  => '表',
    'body'  => [
        'from' => '分页',
        'size' => '每页数量',
        'sort' => [
            'age' => 'desc' //排序字段。倒序
]
] 
];
```

结果：

```php
array:4 [▼
  "took" => 25
  "timed_out" => false
  "_shards" => array:4 [▼
    "total" => 5
    "successful" => 5
    "skipped" => 0
    "failed" => 0
  ]
  "hits" => array:3 [▼
    "total" => 31
    "max_score" => null
    "hits" => array:31 [▼
      0 => array:6 [▼
        "_index" => "my_laravel"
        "_type" => "my_users"
        "_id" => "22"
        "_score" => null
        "_source" => array:7 [▶]
        "sort" => array:1 [▶]
      ]
      1 => array:6 [▼
        "_index" => "my_laravel"
        "_type" => "my_users"
        "_id" => "24"
        "_score" => null
        "_source" => array:7 [▶]
        "sort" => array:1 [▶]
      ]
      2 => array:6 [▼
        "_index" => "my_laravel"
        "_type" => "my_users"
        "_id" => "25"
        "_score" => null
        "_source" => array:7 [▶]
        "sort" => array:1 [▶]
      ]
      3 => array:6 [▼
        "_index" => "my_laravel"
        "_type" => "my_users"
        "_id" => "26"
        "_score" => null
        "_source" => array:7 [▼
          "id" => 26
          "user" => "EFgyGC"
          "pass" => "bb35e0f0d28b240278ecffcae5f41f19"
          "email" => "1YUPzAMsv@sohu.com"
          "nickName" => "TwKdIX__25"
          "create_at" => 1553330691
          "update_at" => 1553330691
        ]
        "sort" => array:1 [▼
          0 => -9.2233720368548E+18
        ]
      ]
      4 => array:6 [▶]
      5 => array:6 [▶]
      6 => array:6 [▶]
      7 => array:6 [▶]
      8 => array:6 [▶]
      9 => array:6 [▶]
      10 => array:6 [▶]
      11 => array:6 [▶]
      12 => array:6 [▶]
      13 => array:6 [▶]
      14 => array:6 [▶]
      15 => array:6 [▶]
      16 => array:6 [▶]
      17 => array:6 [▶]
      18 => array:6 [▶]
      19 => array:6 [▶]
      20 => array:6 [▶]
      21 => array:6 [▶]
      22 => array:6 [▶]
      23 => array:6 [▶]
      24 => array:6 [▶]
      25 => array:6 [▶]
      26 => array:6 [▶]
      27 => array:6 [▶]
      28 => array:6 [▶]
      29 => array:6 [▶]
      30 => array:6 [▶]
    ]
  ]
]
```
