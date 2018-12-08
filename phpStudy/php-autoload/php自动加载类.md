## **PHP自动加载类**

##### 在PHP5之前我们还可以使用PHP的自动加载函数`http://php.net/manual/zh/function.autoload.php   __autoload()`,在PHP7之后官方推荐的就是
`http://php.net/manual/zh/function.spl-autoload-register.php  sql_autoload_register()`
**这里就拿它们做比较 `__autoload()` VS `spl_autoload_register()`**
- **`__autoload()`**
  1. 官方给出的说明是尝试加载未定义的类
  2. 它的参数就只有一个 string [$class],字符串类型的要加载的类名
  3. 没有返回值
```php
<?php
//这里我们创建TestClass.php
//./TestClass.php
namespace Test;

class TestClass
{
    public function myTestClas()
    {
        echo "这是测试函数";
    }
}
```

```php
//这里我们创建index.php

./index.php
<?php
function __autoload($className)
{
     $fileName = __DIR__ . '/' . $className .".php";
     include_once($fileName);
}

$obj = new TestClass();
$obj->myTestClass();
```
- **spl_autoload_register()**
  1.官方给出的说法是 注册给定的函数作为 __autoload 的实现，就是我们通过这个函数注册一个函数，我们在这个函数里具体的实现，让文件函数自动加载
  2.参数一：autoload_function
           欲注册的自动装载函数。如果没有提供任何参数，则自动注册 autoload 的默认实现函数spl_autoload()。
    参数二：throw
           此参数设置了 autoload_function 无法成功注册时， spl_autoload_register()是否抛出异常
    参数三：prepend
           如果是 true，spl_autoload_register() 会添加函数到队列之首，而不是队列尾部。
  3.返回值，成功返回true，失败返回false
  
```php
./TestClass.php
<?php

class TestClass
{
    protected $_index;
    public function __construct($index) 
    {
        echo $this->_index = $index;
        echo "<hr />";
        echo "这是 spl_autoload_register()";
    }
}

?>


./index.php

<?php

function myAutoload($class)
{
    include __DIR__ . '/' . $class . '.php';
}

spl_autoload_register('myAutoload');

$obj = new TestClass('Index');
```
【这里有一个比较正式的实现---》https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md】
```php
<?php 

function myAutoload($className)
{
    $className = ltrim($className,'\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className,'\\')) {
        $namespace = substr($className,0,$lastNsPos);
        $className = substr($className,$lastNsPos + 1);
        $fileName  = str_replace('\\',DIRECTORY_SEPARATOR,$namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
    
    require $fileName;
}

spl_autoload_register('myAutoload');

```