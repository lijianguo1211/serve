<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/30
 * Time: 16:26
 */

class Swool
{
    private $server;

    private $host;

    private $port;

    public function __construct(string $host,string $port)
    {
        $this->host = $host;
        $this->port = $port;

        /**
         * new 一下swoole_http_server
         */
        $this->server = new swoole_http_server($this->host,$this->port);

        /**
         * 设置服务的参数
         * 进程数
         */
    }
}
