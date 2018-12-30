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