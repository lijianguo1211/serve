### 数组函数

----

这里所记载的数组函数是我在平时经常遇到的，需加强记忆的

- 建立一个数组，包含变量名和它们的值

```php
<?php
compact($var1,[$var2]);

//例子：

$name = 'liyi';
$city = 'wuhan';

compact($name,$city);
```

- 将回调函数 callback 迭代地作用到 array 数组中的每一个单元中，从而将数组简化为单一的值

```php
mixed array_reduce ( array $array , callable $callback [, mixed $initial = NULL ] )

/*
参数1：
$array => 输入的数组
参数2：
callable => 回调函数 mixed callback ( mixed $carry , mixed $item )
    参数2.1：$carry => 携带上次迭代里的值； 如果本次迭代是第一次，那么这个值是 initial。
    
    参数2.2：$item => 携带了本次迭代的值。
参数3：
initial => 如果指定了可选参数 initial，该参数将在处理开始前使用，或者当处理结束，数组为空时的最后一个结果
*/
```