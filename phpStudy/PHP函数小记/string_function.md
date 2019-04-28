### PHP字符串函数`strpos`注意事项

对PHP这种弱类型语言来说，初识使用起来很爽快，但是稍微不注意，就会导致整个程序的奔溃，下面就来就函数strpos来做一个使用笔记

- `strpos` 【查找字符串首次出现的位置】

```php
int strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )

//返回 needle 在 haystack 中首次出现的数字位置。

$haystack //在此字符串中查找

$needle //如果 needle 不是一个字符串，那么它将被转换为整型并被视为字符的顺序值。

$offset //可选参数，如果设置它，那么搜索会从字符串该字符数的起始位置开始统计。 如果是负数，搜索会从字符串结尾指定字符数开始。
```

查找函数，`strpos`注意事项，PHP是弱类型语言，所以这个地方会有一个小小的注意。我们知道，`strpos`函数，是查找子字符串在字符串中首次出现的位置，返回
值是`int`类型的，没有找到，返回false。比如下面这样：

```php
<?php
$haystack = 'download';
$needle = 'download';
if (strpos($haystack,$needle) == false) {
    echo 'not appear';
}

//not appear
```
最后打印出来就是`not appear`。是不是觉得很郁闷，明明是一样的，为什么显示没有找到呢，这个原因就是PHP是弱类型语言的锅，其实如果你打印返回值的话是没有
问题的，会出现 返回值`0`。但是你再用的它的返回值0和false做比较，使用的是`==`而不是`===`的话，它就会出现你的到的答案不对的情况。向下面这样的就没问
题了。

```php
<?php
$haystack = 'download';
$needle = 'download';
if (strpos($haystack,$needle) === false) {
    echo 'not appear';
}

//download 出现了
```

其实向上面这样的函数，在PHP中还有很多，所以我们在使用的时候还需要特加注意
