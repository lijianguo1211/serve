<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 16:10
 */

require_once 'Log.php';
require_once 'FileLog.php';

class User
{
    private $log;

    public function __construct(FileLog $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        $this->log->write();
    }
}


function make($concreate)
{
    //user类的反射类
    $reflector = new ReflectionClass($concreate);
    //构造函数
    $construct = $reflector->getConstructor();

    //判断是否有构造函数,没有构造函数，也就没有依赖参数
    if(is_null($construct)) {
        return $reflector->newInstance();
    }

    //有构造函数，得到参数
    $params = $construct->getParameters();

    //根据参数返回实例
    $instance = getDependencies($params);
    //生成User类
    return $reflector->newInstanceArgs($instance);
}

function getDependencies($params)
{
    $dependencies = [];

    foreach ($params as $param) {
        $dependencies[] = make($param->getClass()->name);
    }

    return $dependencies;
}

$user = make('User');

$user->login();
