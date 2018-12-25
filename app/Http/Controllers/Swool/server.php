<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/25
 * Time: 14:47
 */

//创建websocket服务器对象，监听0.0.0.0:9502端口
$ws = new swoole_websocket_server("0.0.0.0", 9502);

//监听WebSocket连接打开事件
$ws->on('open',function($fw,$request){
    echo '有人连接 \n';
    //var_dump($request);
    $fw->push($request->fd,'hello:'.$request->fd);
});
//监听WebSocket消息事件
$ws->on('message', function ($fw, $frame) {
    echo '有人发消息了';
    //var_dump($frame);
    $fw->push($frame->fd,'【你发的消息是：】'.$frame->data);
});

//监听WebSocket连接关闭事件
$ws->on('close', function ($ws, $fd) {
    echo "关闭连接了\n";
    echo "client-{$fd} is closed\n";
});

//开启服务
$ws->start();