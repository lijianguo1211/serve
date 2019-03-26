<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 16:58
 */

class Ioc
{
    public $binding = [];

    public function bind($abstract,$concrete)
    {
        $this->binding[$abstract]['concrete'] = function($ioc) use ($concrete) {
            return $ioc->build($concrete);
        };
    }

    public function make($abstract)
    {
        $concrete = $this->binding[$abstract]['concrete'];
        return $concrete($this);
    }

    /**
     * @TODO 创建对象
     * @param $concrete
     * @return object
     * @throws ReflectionException
     */
    public function build($concrete)
    {
        //$concrete 代表的就是完整命名空间的类名
        $reflector = new ReflectionClass($concrete);
        //得到构造函数
        $construct = $reflector->getConstructor();
        //构造函数是否为空
        if(is_null($construct)) {
            //直接返回实例
            return $reflector->newInstance();
        }
        //尝试得到构造函数的依赖参数
        $dependencies = $construct->getParameters();
        //尝试得到构造函数的依赖参数的实例
        $instance = $this->getDependencies($dependencies);
        //根据依赖参数依赖注入，得到当前需要的对象
        return $reflector->newInstanceArgs($instance);
    }

    /**
     * @TODO 获取参数的依赖
     * @param $params
     * @return array
     */
    protected function getDependencies($params):array
    {
        $dependencies = [];

        foreach ($params as $param) {
            //得到依赖参数的名字，再递归得到依赖参数的实例
            $dependencies[] = $this->make($param->getClass()->name);
        }
        return $dependencies;
    }
}
