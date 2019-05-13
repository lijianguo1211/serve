## laravel框架中url相关(一)

* 助手函数 `url()`

* `URL` facade

1. 通过助手函数和`URL`的`facade`都可以访问url相关的函数，比如我们要访问当前的url

```php
url()->current();

URL::current();
```

这两种方式都可以得到当前访问的url,最后的输出都是`http://admin123456.pc:8001/testHash`,当然使用静态方法访问，一样是需要引入这个Facade类的。
打印出`url`的`facade`类`URL::class`,最后得到的结果是：`Illuminate\Support\Facades\URL`。也就是在使用的时候需要`use Illuminate\Support\Facades\URL`

2. 得到上一次请求的url

```php
url()->previous();

URL::previous();
```

我测试的时候第一次请求`http://admin123456.pc:8001/admin/index`,之后再次请求`http://admin123456.pc:8001/testHash`。得到的打印结果就是
`http://admin123456.pc:8001/admin/index`

3. 得到某一个路由的url

```php
url()->route('login');

URL::route('logout');
```

4. 获取控制器操作（行为）的url

```php
url()->action('IndexController@liyi');

URL::action('IndexController@liyi');
```

5. 得到应用资源的url（我测试的时候拿的是public目录下的资源做的测试）

```php
url()->asset('upload/hotspot/1.jpg');

URL::asset('upload/hotspot/1.jpg')
```

6. 为给定的资源生成一个安全的url （这一个资源的路径可以是不存在的，它是提前生成一个你想要设定的url）

```php
echo url()->asset('upload/hotspot/2.jpg');

echo URL::asset('upload/hotspot/2.jpg');
//我的这个2.jpg就是不存在的
```
**上面这几个方法都是在laravel里面已经实现了的：** 我们都知道，设计模式里面有一点就是面向接口开发，laravel就是完美的诠释了这一点。这几个方法首先laravel
在`namespace Illuminate\Contracts\Routing; interface UrlGenerator{}`这里面定义，然后再去具体的实现，实现是在：

```php
namespace Illuminate\Routing;

class UrlGenerator implements UrlGeneratorContract{}
```

>ps 这里的`UrlGeneratorContract`是起的别名，就是上面的那个接口文件

7. 命名路由的url

一般在写每个请求的时候，我们都会先在路由文件里面定有一个路由，然后再去实现具体的请求方法。比如：我们现在写一个测试的请求test,以get方式请求,在laravel
里面，我们可以这样写：这个文件是在`/route/web.php`


```php
Route::get('test/{id}','TestController@test')->name('test.index')

//同样我们想要得到这个路由的url，就可以这样写：

echo route('test.index',['id'=>12]);

//最后输出就是  http://admin123456.pc:8001/test/12
```

同时，我们这个地方的第二参数数组里面的值还可以传递 `Eloquent 模型`,比如我们传递用户表的模型，注意：这里只能是查询单个的,它会自动转化把id放进去

```php
$user = (new User())->get();
        foreach($user as $item) {
            echo route('test.index',['id'=>$item]);
            echo "<br />";
        }
```

