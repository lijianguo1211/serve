<?php

namespace App\Http\Controllers\Test;

/**
 * 容器类。装实例，提供实例的回调函数
 * Class Container
 * @package App\Http\Controllers\Test
 */
class Container
{
    protected $bindings = [];

    public function bind()
    {

    }

    public function make()
    {

    }

    public function build()
    {

    }

    //默认生成的实例回调函数
    public function getClosure($abstract,$contrete)
    {
        return function($c) use ($abstract,$contrete)
        {
            $method = ($abstract == $contrete) ? 'build' : 'make';

            return $c->$method($contrete);
        };
    }
}
