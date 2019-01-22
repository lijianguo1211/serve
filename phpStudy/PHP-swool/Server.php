<?php
/**
 * websocket 服务端
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/1/20
 * Time: 16:52
 */

class Server
{
    private static $instance = null;

    private static $server;

    protected $host = '0.0.0.0';

    protected $port = 9502;

    private function __construct()
    {
        self::$server = new swoole_websocket_server($this->host,$this->port);
        self::$server->on('open',[$this,'onOpen']);
        self::$server->on('message',[$this,'onMessage']);
        self::$server->on('close',[$this,'onClose']);
        self::$server->on('workerStart',[$this,'onWorkerStart']);
        self::$server->on('request',[$this,'onRequest']);
    }

    /**
     * 监听WebSocket连接打开事件
     * @param $servers
     * @param $req
     */
    public function onOpen($ser,$req)
    {
        var_dump($ser);
        print '-------------';
        var_dump($req);
        $ser->push($req->fd,$req->fd.' 用户上线了');
    }

    /**
     * 监听WebSocket消息事件
     * @param $ser
     * @param $frame
     */
    public function onMessage($ser,$frame)
    {
        var_dump($ser);
        print '-------------';
        var_dump($frame);
        $ser->push($frame->fd,$frame->data);
    }

    /**
     * 监听WebSocket连接关闭事件
     * @param $ser
     * @param $fd
     */
    public function onClose($ser,$fd)
    {
        var_dump($ser);
        print '-------------';
        var_dump($fd);
        $ser->push($fd,json_encode([$fd => '用户下线了']));
    }

    public function onRequest()
    {

    }

    public function onWorkerStart()
    {

    }

    /**
     * @return null|Server
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 启动服务器
     */
    public function start()
    {
        self::$server->start();
    }

    /**
     *
     */
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
}

Server::getInstance();
