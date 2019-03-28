
## 一
```php
namespace Illuminate\Routing;
class Router implements RegistrarContract, BindingRegistrar
{
    protected function findRoute($request){}
}

```


## 二
```php
namespace Illuminate\Routing;

class RouteCollection implements Countable, IteratorAggregate
{
    public function match(Request $request){}
}
```

## 三
```php
public function match(Request $request)
{
    $routes = $this->get($request->getMethod());
}


namespace Symfony\Component\HttpFoundation;

class Request
{
     public function getMethod()
}

public function get($method = null){}

```

## 四
```php
public function match(Request $request)
{
    $routes = $this->get($request->getMethod());
    
    $route = $this->matchAgainstRoutes($routes, $request);
}

```

