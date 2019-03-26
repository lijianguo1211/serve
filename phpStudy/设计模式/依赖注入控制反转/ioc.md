### 依赖注入控制反转

* 定义一个写日志的接口  `Log.php`

写日志的驱动可以有很多种，比如：[文件，数据库]，它们根据接口类来具体的实现

```php
class FileLog implements Log
{
    public function write()
    {
        // TODO: Implement write() method.
    }
}

class DateBaseLog implements Log
{
    public function write()
    {
        // TODO: Implement write() method.
    }
}
```

现在有一个web网站，需要记录每个用户登录时的信息；就有一个`User`的模型,登录处理的逻辑，成功后用文件写日志

```php
class UserFile
{
    private $log;

    public function __construct()
    {
        $this->log = new FileLog();
    }

    public function login()
    {
        /**
         * 登录成功后写日志，目前是用文件的方式写日志
         */
        $this->log->write();
    }
}
```

突然有一天，领导通知你，不用文件写日志了，现在要使用数据库。那么此时你又要修改你的`User`里面的`login`方法：

```php
class UserDataBase
{
    private $log;

    public function __construct()
    {
        $this->log = new DateBaseLog();
    }

    public function login()
    {
        /**
         * 登录成功后写日志，目前是用文件的方式写日志
         */
        $this->log->write();
    }
}
```

如果有一天，这个又要改变了呢，你还要再去改吗？这对于我们来说几乎是不能忍的。所以依赖注入就出现了，我们通过构造函数来实现它，就是我们通过外部来影响内部，
也就是：指组件的依赖通过外部参数或其它形式注入

```php
class UserIoc
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        /**
         * 登录成功后写日志，目前是用文件的方式写日志
         */
        $this->log->write();
    }
}
```

这样的实现的话，我们每次就不用去构造函数里面`new`它了，是不是很舒服。

************************************************************************************************************************
分割线


上面我们知道了依赖注入，那么现在我们了解一下，什么是反射？

PHP自5.0版本以后添加了反射机制，它提供了一套强大的反射API，允许你在PHP运行环境中，访问和使用类、方法、属性、参数和注释等，其功能十分强大，经常用于高
扩展的PHP框架，自动加载插件，自动生成文档，甚至可以用来扩展PHP语言。由于它是PHP內建的oop扩展，为语言本身自带的特性，所以不需要额外添加扩展或者配置就
可以使用

在这里，我们通过反射机制来拿到`User`类里面的各种我们需要的数据：

```php
class User
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        $this->log->write();
    }
}

//获取User对象
$reflector = new ReflectionClass(User::class);

//获取User对象的构造函数
$construct = $reflector->getConstructor();

//获取User对象的构造函数的依赖参数
$constructParams = $construct->getParameters();

//创建User对象,没有参数
$user = $reflector->newInstance();

//创造User对象，需要传递参数
$user = $reflector->newInstanceArgs($constructParams);

$user->login();
```

在这里，上面的构造函数，需要修改一下：

```php
public function __construct()
    {
        $this->log = new FileLog();
    }
```

这样就可以正常输出了，动态接口性质的，这里还没有实现，下面是更加纤细的实现

```php
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


```


### 服务容器IOC具体的实现

```php
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

```

````php
<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 16:56
 */

require_once 'Ioc.php';
require_once 'Log.php';
require_once 'FileLog.php';
require_once 'DateBaseLog.php';

class UserIoc
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        $this->log->write();
    }
}

$ioc = new Ioc();

$ioc->bind('Log','FileLog');
$ioc->bind('user','UserIoc');
$user = $ioc->make('user');

$user->login();

````
