### PHP反射

> PHP 5 具有完整的反射 API，添加了对类、接口、函数、方法和扩展进行反向工程的能力。 此外，反射 API 提供了方法来取出函数、类和方法中的文档注释

```php
<?php

class Test
{
    /**
     * @var
     */
    private $salary;

    /**
     * @var
     */
    private $fun;

    /**
     * @var
     */
    protected $age;

    /**
     * @var
     */
    public $name;

    /**
     * Test constructor.
     * @param $salary
     * @param $age
     * @param $name
     */
    public function __construct($salary, $age, $name)
    {
        $this->salaly = $salary;
        $this->age    = $age;
        $this->name   = $name;
    }

    /**
     * @return string
     */
    protected function setFun()
    {
        return $this->fun = 'function';
    }

    /**
     * @return mixed
     */
    public function getFun()
    {
        return $this->fun;
    }

    /**
     *
     */
    private function index()
    {
        echo '你们都看不到我吧！';
    }

}

//反射得到类
$class = new ReflectionClass('Test');

echo "<pre>";
print_r($class);
echo "</pre>";

echo "<hr />";
echo "<h1>文档注释</h1>";
echo "<pre>";
print_r($class->getDocComment());
echo "</pre>";

echo "<hr />";
echo "<h1>属性名</h1>";
echo "<pre>";
print_r($class->getProperties());
echo "</pre>";

echo "<hr />";
echo "<h1>构造函数</h1>";
echo "<pre>";
print_r($class->getConstructor());
echo "</pre>";


echo "<hr />";
echo "<h1>构造函数参数名：</h1>";
echo "<pre>";
print_r($class->getConstructor()->getParameters());
echo "</pre>";

echo "<hr />";
echo "<h1>获取方法数组：</h1>";
echo "<pre>";
print_r($class->getMethods());
echo "</pre>";
?>
```