### php中使用trait
PHP一直都是一门单继承的语言，单继承的语言有好处，也有不好，最起码在代码复用这方面是没有c++这种多继承语言好用的。
虽然我们是单继承语言，但是我们也在想我们的方法呀，所以在那些聪明人的努力下：
PHP从5.4.0起，PHP家族多了一个trait “小伙伴”；就是它【trait】帮我们实现了一种代码复用

> **Trait 是为类似 PHP 的单继承语言而准备的一种代码复用机制。Trait 为了减少单继承语言的限制，使开发人员能够自由地在不同层次结构内独立的类中复用 method。Trait 和 Class 组合的语义定义了一种减少复杂性的方式，避免传统多继承和 Mixin 类相关典型问题。
Trait 和 Class 相似，但仅仅旨在用细粒度和一致的方式来组合功能。 无法通过 trait 自身来实例化。它为传统继承增加了水平特性的组合；也就是说，应用的几个 Class 之间不需要继承。**

下面我们来总结一下Trait的特点：

- 需要用`use`关键字来引入类的内部
- 多个trait 引入使用逗号隔开`use test1,test2`
- Trait 不能实例化，它是通过别的类来调用它


1. 基本使用
```php
<?php 
namespace App\Traits;
Trait TestOne
{
    public function indexTestOne()
    {
        echo "One";
    }
}

?>

<?php 
namespace App\Traits;
Trait TestTwo
{
    public function indexTestTwo()
    {
        echo "Two";
    }
}

?>

<?php 
namespace App\Http\Controllers\Home;
use App\Traits\TestOne; 
use App\Traits\TestTwo;
Class TestClass
{
    use TestOne,TestTwo;
    public function edit()
    {
        $this->indexTestOne();
        echo "这是普通类的edit方法 <br />";
    }
}

```
下面这是输出：

![最简单应用](trait_test1.png)


- Trait的优先级问题
  1. trait优先级大于基类
  2. 本类的优先级大于trait
  
  注意：**从基类继承的成员会被 trait 插入的成员所覆盖。优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法**

```php

```



