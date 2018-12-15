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


2. Trait的优先级问题
  2.1. trait优先级大于基类
  2.2. 本类的优先级大于trait
  
  注意：**从基类继承的成员会被 trait 插入的成员所覆盖。优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法**

```php
<?php

namespace App\Http\Controllers\Home;
use App\Traits\Priority;

class SonController extends Base
{
    use Priority;
    public function index()
    {
        echo '这是当前类sonController的方法 index()';
    }
}
?>


<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 17:27
 */
namespace App\Http\Controllers\Home;

class Base
{
    public function index()
    {
        echo '这是Base class 类里的方法 index()';
    }

    public function edit()
    {
        echo '这是Base class 类里的方法 edit()';
    }
}
?>


<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 17:24
 */
namespace App\Traits;

trait Priority
{
    public function index()
    {
        echo '这是Priority trait 里的index() 方法';
    }
    
    public function edit()
    {
        //parent::edit();
        echo '这是Priority trait 里的edit() 方法';
    }

}
?>
```
输出如图所示：当前类的优先级最高，所以输出的是当前类的方法

![优先级1](trait_test2.png)


现在我们`(new HomeController)->edit()`这个方法输出： 输出的是我们trait里的方法，说明我们trait优先级大于基类

![优先级2](trait_test3.png)

如果我们把trait里的edit()方法修改一下
```php
<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 17:24
 */
namespace App\Traits;

trait Priority
{
    public function index()
    {
        echo '这是Priority trait 里的index() 方法';
    }

    public function edit()
    {
        parent::edit();
        echo '这是Priority trait 里的edit() 方法';
    }
}
?>
```

这次再`(new SonController)->edit()`,得到的输出就是trait里的edit()方法和基类Base里的edit()方法，如下：

![优先级3](trait_test4.png)


3. **Trait之间的冲突解决方法**

冲突其实在我们的代码中其实是很常见的，尤其我们在给我们的方法【函数】命名的时候，绞尽脑汁的想呀想。是个非常方的事情

在trait中也是如此，比如我们有两个trait，两个中都有store方法和save方法，这个时候如果我们在同一个类中，同时引入了它们两个
就好像下面这样：

```php
<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/13
 * Time: 16:03
 */
namespace App\Traits;

trait Three
{
    public function save()
    {
        echo '这是Three里的save()方法';
    }

    public function store()
    {
        echo '这是Three里的store()方法';
    }
}
?>

<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 18:01
 */
namespace App\Traits;

trait Four
{
    public function save()
    {
        echo '这是Fore里的save()方法';
    }

    public function store()
    {
        echo '这是Fore里的store()方法';
    }
}
?>

<?php

namespace App\Http\Controllers\Home;

use App\Traits\Three;
use App\Traits\Four;

class FivesController
{
    use Three,Four;
}
?>
```

如果像我们这样直接引入，然后直接调用方法：
```php
(new FivesController())->save();
echo "<br />";
(new FivesController())->store();
```

那么我们最后得到的结果就是如下：
![冲突解决1](trait_test5.png)

所以我们需要在引入的时候指定我们需要用哪个trait里的那个方法。**为了解决多个 trait 在同一个类中的命名冲突，需要使用 insteadof 操作符来明确指定使用冲突方法中的哪一个。**
```php
<?php

namespace App\Http\Controllers\Home;

use App\Traits\Three;
use App\Traits\Four;

class FivesController
{
    use Three,Four{
        Three::save insteadof Four;
        Four::store insteadof Three;
    }
}
?>
```
之后我们再做同样的调用的时候，它就知道我们调用的save()方法是Three里的，而调用store()方法是Four的.如下：
![冲突解决2](trait_test6.png)

在调用的时候【insteadof】关键字好像就是告诉你它前面的代替它后面的


以上方式仅允许排除掉其它方法，as 操作符可以 为某个方法引入别名。 注意，as 操作符不会对方法进行重命名，也不会影响其方法。
像上面就是我们只得其一，这样我们还不满意，就是想鱼和熊掌兼得的话，我们就可以使用as关键字
像下面这样：
```php
<?php

namespace App\Http\Controllers\Home;

use App\Traits\Three;
use App\Traits\Four;

class SixController
{
    use Three,Four{
        Three::save insteadof Four;//Three::save里的方法代替Four里的save方法输出
        Four::save as save1;//Four里的方法起别名输出
        Four::store insteadof Three;
        Three::store as store1;
    }
}
?>
```

最后得到的效果图如下：
![解决冲突3](trait_test7.png)

我们先使用关键字【insteadof】对方法进行代替，然后用关键字【as】对被代替的方法起别名，然后调用输出
```php
(new SixController())->save();
echo "<br />";
(new SixController())->store();
echo "<br />";
(new SixController())->save1();
echo "<br />";
(new SixController())->store1();
```

我们使用关键字【as】还可以修改这个方法的访问控制权