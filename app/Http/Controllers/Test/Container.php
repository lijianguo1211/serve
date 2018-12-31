<?php

namespace App\Http\Controllers\Test;

use Mockery\Matcher\Closure;

/**
 * 容器类。装实例，提供实例的回调函数
 * Class Container
 * @package App\Http\Controllers\Test
 */
class Container
{
    protected $bindings = [];

    /**
     * 绑定接口和生成响应的实例的回调函数
     * @param $abstract
     * @param null $concrete
     * @param bool $shared
     */
    public function bind($abstract, $concrete = null, $shared = false)
    {
        if (!$concrete instanceof Closure)
        {
            //如果提供的参数不是回调函数，则产生默认的回调函数
            $concrete = $this->getClosure($abstract, $concrete);
        }

        $this->bindings[$abstract] = compact('concrete','shared');
    }

    /**
     * 生成实例对象，首先解决接口和要实例化类之间的依赖关系
     * @param $abstract
     */
    public function make($abstract)
    {
        $concrete = $this->getConcrete($abstract);

        if ($this->isBuildable($concrete, $abstract))
        {
            $object = $this->build($concrete);
        }
        else
        {
            $object = $this->make($concrete);
        }

        return $object;
    }

    /**
     * 实例化对象
     * @param $concrete
     * @return mixed
     */
    public function build($concrete)
    {
        if ($concrete instanceof Closure)
        {
            return $concrete($this);
        }

        $reflector = new ReflectionClass($concrete);//报告了一个类的有关信息

        if (!$reflector->isInstantiable())//检查类是否可实例化
        {
            echo $message = "Target [$concrete] is not instantiable.";
        }

        $constructor = $reflector->getConstructor();// 获取类的构造函数

        if (is_null($constructor))
        {
            return new $concrete;
        }
        $dependencies = $constructor->getParameters();//获取构造函数的参数名[数组形式]
        $instances = $this->getDependencies($dependencies);
        return $reflector->newInstanceArgs($instances);//从给出的参数创建一个新的类实例
    }

    /**
     * 默认生成的实例回调函数
     * @param $abstract
     * @param $contrete
     * @return \Closure
     */
    public function getClosure($abstract,$contrete)
    {
        //生成实例的回调函数，$c一般为IOC容器对象，在调用回调生成实例时提供，即build函数中的$concrete($this)
        return function($c) use ($abstract,$contrete)
        {
            $method = ($abstract == $contrete) ? 'build' : 'make';
            //调用的是容器的build或make方法生成实例
            return $c->$method($contrete);
        };
    }


    /**
     * 获取绑定的回调函数
     * @param $abstract
     * @return mixed
     */
    public function getConcrete($abstract)
    {
        if (!isset($this->bindings[$abstract]))
        {
            return $abstract;
        }

        return $this->bindings[$abstract]['concrete'];
    }

    public function isBuildable($concrete, $abstract)
    {
        return $concrete === $abstract || $concrete instanceof Closure;
    }

    /**
     * 反射机制实例化对象时的依赖
     * @param $parameters
     * @return array
     */
    protected function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter)
        {
            $dependency = $parameter->getClass();
            if (is_null($dependency))
            {
                $dependencies[] = null;
            }
            else
            {
                $dependencies[] = $this->resolveClass($parameter);
            }
        }

        return (array)$dependencies;
    }

    protected function resolceClass(\ReflectionParameter $parameter)
    {
        return $this->make($parameter->getClass()->name);
    }

}
