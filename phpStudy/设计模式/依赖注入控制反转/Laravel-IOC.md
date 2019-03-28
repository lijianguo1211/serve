* 第一步

```php
Route::get('/', function () {
    return view('welcome');
});
```

前面没有use，也没有引入，直接使用静态方法`get()`

```
namespace Illuminate\Support\Facades;

class Route extends Facade
{
    protected static function getFacadeAccessor();
}

namespace Illuminate\Support\Facades;

abstract class Facade
{
     public static function __callStatic($method, $args)
        {
            $instance = static::getFacadeRoot();

            if (! $instance) {
                throw new RuntimeException('A facade root has not been set.');
            }

            return $instance->$method(...$args);
        }
}
```

在`Route`和`Facade`里面都没有静态方法`get()`,但是在`Facade`里面有一个静态的魔术方法`__callStatic($method, $args)`

`__callStatic` **当调用的静态方法不存在或权限不足时，会自动调用__callStatic方法。**

它又两个参数，第一个参数：`method` 调用的方法名；第二参数：`args`调用方法的参数

现在就回走这个魔术方法，然后走`static::getFacadeRoot();`

```php
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
```

这个方法里面`static::getFacadeAccessor()`

```php
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }
```

刚好在这里，我们实现了这个方法

```php
namespace Illuminate\Support\Facades;

class Route extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
```

所以，`static::getFacadeAccessor()`得到的就是`router`

```php
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance('router');
    }
```

继续看`static::resolveFacadeInstance('router')`这个方法

```php
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        return static::$resolvedInstance[$name] = static::$app[$name];
    }
```

显然，这里的`$name = 'router'`,也就是说，第一步判断是否是对象，是不会进去了，因为是字符串。第二个`if`

`static::$resolvedInstance[$name]`具体看这个静态变量数组里面是否有`router`。如果是第一次执行，那就是没有，如果不是第一次就可以直接返回。
没有的话。执行`static::$app[$name]`

其实这个静态变量`$app`就是指laravel容器`Application`

最后回到`__callStatic($method, $args)`这个魔术方法，`method`=>`get`,'args' => ['/',function () {
                                                                            return view('welcome');
                                                                        }]
也就是说最后，`Application`这个实例要访问`router`这个属性，很显然，`Application`它里面没有。但是它继承了

```
namespace Illuminate\Container;
class Container implements ArrayAccess, ContainerContract
{
        public function offsetGet($key)
        {
            return $this->make($key);
        }
}
```

也就是说`Application->make('router')`了一个实例，对于`Illuminate\Support\Facades\Route`里面是没有`get()`方法的。但是它在开始的注释里
`@method static \Illuminate\Support\Facades\Route get(string $uri, \Closure|array|string|null $action = null)`有说明。也就
是在==》 `Illuminate\Routing @class Router implements RegistrarContract, BindingRegistrar`这个里面有

```
    @1
    public function get($uri, $action = null)
    {
        return $this->addRoute(['GET', 'HEAD'], $uri, $action);
    }

    @2
    protected function addRoute($methods, $uri, $action)
    {
        return $this->routes->add($this->createRoute($methods, $uri, $action));
    }

    @3
    protected function createRoute($methods, $uri, $action)
    {
        if ($this->actionReferencesController($action)) {
            $action = $this->convertToControllerAction($action);
        }

        $route = $this->newRoute(
            $methods, $this->prefix($uri), $action
        );

        if ($this->hasGroupStack()) {
            $this->mergeGroupAttributesIntoRoute($route);
        }

        $this->addWhereClausesToRoute($route);

        return $route;
    }

    @3.1 返回一个布尔值，判断action是否是一个字符串，这里，是个数组,不是一个字符串，所以不走这个if
    protected function actionReferencesController($action)
    {
        if (! $action instanceof Closure) {
            return is_string($action) || (isset($action['uses']) && is_string($action['uses']));
        }

        return false;
    }

    @3.2 拼接URI，得到路由前缀的URI
    protected function prefix($uri)
    {
        return trim(trim($this->getLastGroupPrefix(), '/').'/'.trim($uri, '/'), '/') ?: '/';
    }

    @3.3 methods => [get,head], uri=>'/',action=>[是路由中的闭包函数转化的数组参数]
    // setRouter(Illuminate\Routing\Router)
    // setContainer(Illuminate\Container\Container)
    // new Route => new Illuminate\Routing\Route()
    protected function newRoute($methods, $uri, $action)
    {
        return (new Route($methods, $uri, $action))
                    ->setRouter($this)
                    ->setContainer($this->container);
    }

    @4
    public function add(Route $route)
    {
        $this->addToCollections($route);

        $this->addLookups($route);

        return $route;
    }
    ....
```

后面还有好多。。。









