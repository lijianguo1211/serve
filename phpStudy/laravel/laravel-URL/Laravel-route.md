## Laravel-route 路由

* 基本路由

* 路由参数

* 资源路由

* 命名空间

* 路由前缀

* 路由中间件

**最先了解的就是`laravel`的路由文件所在地:**

laravel路由所在的文件就是在项目的根目录下面的`/route/web.php|api.php|...`

基本路由写法：

```php
Route::get('/',function(){
    return view('index');
);

Route::get('/',function(){
    return "<h1>hello laravel !!!<h1/>";
);
```

前面可以是一个路由名`URI`，后面可以传递一个闭包函数，真是很方便也好理解。比如下面这样：

```php
//只允许get方法访问
Route::get('index',function(){
               return 123;
);

//只允许post方法访问
Route::post('index',function(){
               return 123;
);

//只允许put方法访问
Route::put('index',function(){
               return 123;
);

//只允许patch方法访问
Route::patch('index',function(){
               return 123;
);

//只允许delete方法访问
Route::delete('index',function(){
               return 123;
);

//只允许options方法访问
Route::options('index',function(){
               return 123;
);
           
//任何方法访问
Route::any('index',function(){
               return 123;
);           
```

* ps 同样的，我们在写路由的时候，我觉得为了方便或者说规范，在写的时候就给我们每个访问的url规定好访问的方法，这是很有必要的，这样除了问题，也可以很好
的定位，同样的，你写的是get访问的路由，请求的时候如果是不按照规定的来，这个时候laravel就不会允许你的请求。同样的laravel也允许你偷懒，那就是`any()`
方法，你可以是任意的方法请求进来。但是，但是，但是，HTML里面的form表单，这个只支持get和post方法访问，这个时候，我们使用laravel就可以很好的来做表单
方法伪造，如果你使用的是laravel的blade模板，这个时候就很简单了，下面这样：

```php
<input type="hidden" name="_method" value="put"/>
<input type="hidden" name="_method" value="delete"/>
<input type="hidden" name="_method" value="patch"/>
```

当然上面只是一种方式，而且是最好记忆的，最好理解的，laravel还提供了辅助函数，这个就需要我们自己去探讨了，但是辅助方法的本质就是上面的样子。所以理解了
上面的这样的写法，那么任何辅助函数就好理解的，辅助函数也是让我们书写更加方便快捷。比如laravel提供的`{{ method_field('PUT')}}`

同样的在基本路由中，我们不仅可以传递闭包函数，还可以和控制器绑定，下面这样

```php
Route::get('index','IndexController@index');
```

它的第二个参数就是：控制器@控制器里面的方法名。这样的写法一目了然，很容易的见名知意。

* 基本路由之重定向路由：

```php
Route::redirect('index','one',302)
```

这里想要访问一个路由，然后让它跳转到别的路由上去，就可以使用重定向路由，它有三个参数：

参数一：访问的uri
参数二：要跳转到的uri
参数三：跳转的状态码

* 基本路由之视图路由，在这里如果你使用的是`laravel`的`blade`模板编写的页面展示，那么就可以这样写：

```php
Route::view('test','index');
```

这里使用的就是view()方法，它会自动渲染到对应的视图文件。比如我们在安装laravel的时候，打开你的项目，然后访问首页。是一个laravel自定义的页面，我们
就可以把它改为这样：

```php
Route::view('/','welcome');
```

这个`view()`方法同样需要三个参数：

参数一：需要访问的uri
参数二：需要显示的视图
参数三：传递给视图的参数，是一个数组

**注意：** 这里的参数一和参数二都是必传的参数，参数三是选传的


* 路由参数以及正则表达式过滤

路由参数可以分为必穿参数和可选参数，它们的写法如下：

```php
Route::get('index/{id}','IndexController@index');

Route::get('index/{id}?','IndexController@index');

```

传递的参数需要加上花括号，用花括号包裹起来就是参数名，当然这个参数名可以随便起，最好是形象的最好，这个不做过多的要求，比如要查询具体的那一篇文章，就需
要传递文章的id，这个时候就可以在路由中加入id这个参数。同时，id只能是数字，就可以再次加上正则表达式的过滤，写法如下：

```php
//这里是支持PHP中所有正则表达式的写法的，只能让请求的数据传递数字也就是0-9的int类型数字
Route::get('index/{id}','IndexController@index')->where('id', '[0-9]+');
```

同时有的时候，参数不是必须传递的时候，就可以在花括号的后面加上一个问号`?`，这个时候就代表，你可以传递参数，也可以不传递参数，请求都可以顺利到达。还有
一点,参数同样可以传递的不止一个，可以传递多个参数。下面这样的写法：

```php
Route::get('index/{id}?/test/{com}')->where(['com','[a-z]+']);
```

上面这样的还可以写很多，只要你有需要的都可以写进去。只要用大括号包裹起来就可以了。不是必传的参数就直接在后面加上问号就好了。


* 资源路由，在laravel里这个就是最简单的路由了，个人觉得这个是最简单的。也是写的最少的，做后台的管理系统时，增删改查，这个时最好实现的没只要区区一行
代码就可以实现，如下：

```php
Route::resource('index','IndexController');
```

写法简单，下面是它的详解：

```php
|metthod   | uri                |controller@function  |                           |
|             
| get      |/index              |function index()     |得到一个展示列表 [list]        |
|
| get      |/index/create       |function create()    |显示创建的form表单             |
|
| get      |/index{id}          |function show()      |显示对应id的内容               |
|
| get      |/index/{id}/edit    |function edit()      |对应id编辑显示form表单         |
|
| post     |/index              |function store()     | 表单提交的内容                |
|
| put      |/index/{id}         |function save()      |对应编辑的form表单内容提交[更新]  |
|
| delete   |/index/{id}         |function destory()   |删除对应id的内容。[删除]         |
 ```

>ps 当然上面几个`put|delete`这是需要在表单提交的时候做表单伪造了。还有一点，在资源路由后面还可以加上两个函数`only()`和`except()`其中`only()`
方法是对那几个方法使用资源路由，`except()`这个方法是排除那几个方法不使用资源路由。


* 命名空间，这个也是为了方法项目归类使用的。当一个项目太大的时候，有不同的模块。对应不同的路由。那个时候路由就太多了，所以不同命名空间下的路由在不同的
分类下，这样也利于项目的友好展现。比如我自己的个人项目。有一个后台管理模块。有一个前台展示模块。有一个测试模块。那么我就可以这样写：

```php
Route::group(['namespace'=>'Admin'],function(){

});

Route::group(['namespace'=>'Home'],function(){

});

Route::group(['namespace'=>'Test'],function(){

});

Route::namespace('Admin')->group(function(){});
Route::namespace('Home')->group(function(){});
Route::namespace('Test')->group(function(){});
```

这样我对应的在`/app/http/controllers/`下面，我也是同样有`Admin|Home|Test`文件夹。这样使用了命名空间路由。就可以少写很多代码，不用每次还要加
上前面的命名空间的那一大串

* 路由前缀，这个同样是为了偷懒，哈哈，这个是我们每次在访问路由的时候，会在前面加上一个前缀。这个可真是为了分门别类而设计的，不然大项目，那么多路由，要
想那么多的名字，难免会有重复的，想想就可怕，但是，如果给不同的模块加上不同的前缀，前缀不同，前缀下面的uri相同，这是没有问题的。如下：

```php
Route::prefix('admin')->group(function(){ Route::get('index',function(){ return 'hello laravel!!!' }) });
Route::prefix('home')->group(function(){ Route::get('index',function(){ return 'hello laravel!!!' }) });
Route::prefix('test')->group(function(){ Route::get('index',function(){ return 'hello laravel!!!' }) });
```

访问的时候，第一个就是 `http://admin123456.pc:8001/admin/index`，第二个：`http://admin123456.pc:8001/home/index`, 第三个：`http://admin123456.pc:8001/test/index`

* 路由中间件，也就是在路由中添加中间件，添加之前，首先你要有中间件，然后去注册完成之后，就可以使用了，如下：

```php
Route::middleware('test')->group(function(){});
```

同样在这个里面添加路由，都会先经过，`test`这个中间件。

