<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/2
 * Time: 10:22
 */

namespace App\Http\Controllers\Api;

use Elasticsearch\ClientBuilder;
use Monolog\Logger;

class ElasticsearchController
{
    private $client = null;

    public function __construct()
    {
        $logger = ClientBuilder::defaultLogger(__DIR__.'/es/'.date('Y-m-d',time()).'.log',Logger::INFO);

        //$defaultHandler = ClientBuilder::defaultHandler();
        //$singleHandler  = ClientBuilder::singleHandler();
        //$multiHandler   = ClientBuilder::multiHandler();

        //$connectionPool = '\Elasticsearch\ConnectionPool\StaticNoPingConnectionPool';

        //$selector = '\Elasticsearch\ConnectionPool\Selectors\StickyRoundRobinSelector';

        //$serializer = '\Elasticsearch\Serializers\SmartSerializer';

        $this->client = ClientBuilder::create()
            //->setHosts(['localhost:9200'])
            //->setRetries(2)
            ->setLogger($logger)
            //->setHandler($defaultHandler)
            //->setConnectionPool($connectionPool)
           // ->setSelector($selector)
            //->setSerializer($serializer)
            ->build();
    }

    public function createDocument()
    {
        $params = [
            'index' => 'laravel',//数据库
            'type' => 'users',//数据表
            'id' => 'id',//主键
            'body' => ['testField' => 'abc']//每条记录
        ];

        $response = $this->client->index($params);
        \Log::info($response);
        dd($response);
    }

    public function getDocument()
    {
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
                'verbose' => false,
                'timeout' => 10,
                'connect_timeout' => 10,
                'future' => 'lazy'
            ]
        ];

        $response = $this->client->get($param);
        \Log::info(json_encode($response));
        dd($response);
    }

    public function existsDocument()
    {
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

        $response = $this->client->exists($param);
        \Log::info($response);
        dd($response);
    }

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

        $response = $this->client->search($param);
        \Log::info($response);
        dd($response);
    }

    public function deleteDocument()
    {
        $param = [
            'index' => 'laravel',
            'type'  => 'users',
            'id'    => 'id',
        ];

        $response = $this->client->delete($param);
        \Log::info($response);
        dd($response);
    }

    public function deleteIndex()
    {
        $deleteParam = [
            'index' => 'my_index'
        ];

        $response = $this->client->indices()->delete($deleteParam);
        \Log::info($response);
        dump($response);
    }

    public function createIndex()
    {
        $params = [
            'index' => 'reuters',
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                    'analysis' => [
                        'filter' => [
                            'shingle' => [
                                'type' => 'shingle'
                            ]
                        ],
                        'char_filter' => [
                            'pre_negs' => [
                                'type' => 'pattern_replace',
                                'pattern' => '(\\w+)\\s+((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\b',
                                'replacement' => '~$1 $2'
                            ],
                            'post_negs' => [
                                'type' => 'pattern_replace',
                                'pattern' => '\\b((?i:never|no|nothing|nowhere|noone|none|not|havent|hasnt|hadnt|cant|couldnt|shouldnt|wont|wouldnt|dont|doesnt|didnt|isnt|arent|aint))\\s+(\\w+)',
                                'replacement' => '$1 ~$2'
                            ]
                        ],
                        'analyzer' => [
                            'reuters' => [
                                'type' => 'custom',
                                'tokenizer' => 'standard',
                                'filter' => ['lowercase', 'stop', 'kstem']
                            ]
                        ]
                    ]
                ],
                'mappings' => [
                    '_default_' => [
                        'properties' => [
                            'title' => [
                                'type' => 'string',
                                'analyzer' => 'reuters',
                                'term_vector' => 'yes',
                                'copy_to' => 'combined'
                            ],
                            'body' => [
                                'type' => 'string',
                                'analyzer' => 'reuters',
                                'term_vector' => 'yes',
                                'copy_to' => 'combined'
                            ],
                            'combined' => [
                                'type' => 'string',
                                'analyzer' => 'reuters',
                                'term_vector' => 'yes'
                            ],
                            'topics' => [
                                'type' => 'string',
                                'index' => 'not_analyzed'
                            ],
                            'places' => [
                                'type' => 'string',
                                'index' => 'not_analyzed'
                            ]
                        ]
                    ],
                    'my_type' => [
                        'properties' => [
                            'my_field' => [
                                'type' => 'string'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->client->indices()->create($params);

        dd($response);
    }

    public function getIndex()
    {
        $response = $this->client->indices()->getMapping();
        dd($response);
    }

    public function updateIndex()
    {
        $param = [
            'index' => 'my_index',
            'type'  => 'my_type',
            'body'  => [
                'my_type2' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'first_name' => 'string',
                        'analyzer' => 'standard'
                    ],
                    'age' => [
                        'type' => 'integer'
                    ]
                ],
            ]
        ];

        $response = $this->client->indices()->putMapping($param);

        dd($response);
    }

    public static function index()
    {
        /**
         * 构造一个对象
         */
        $obj = new \stdClass();
        $obj->index = 123456;
        $obj->indexs = function(){
            $oo = 123456;
        };
        return $obj;
    }
}

