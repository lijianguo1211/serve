### 字符串函数

- `strpos` 【查找字符串首次出现的位置】

```php
int strpos ( string $haystack , mixed $needle [, int $offset = 0 ] )

//返回 needle 在 haystack 中首次出现的数字位置。

$haystack //在此字符串中查找

$needle //如果 needle 不是一个字符串，那么它将被转换为整型并被视为字符的顺序值。

$offset //可选参数，如果设置它，那么搜索会从字符串该字符数的起始位置开始统计。 如果是负数，搜索会从字符串结尾指定字符数开始。
```