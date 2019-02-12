## 随机数

- random_int  生成加密安全的伪随机整数

```php
random_int(1,10000);
```

- random_bytes  生成加密安全的伪随机字节

- bin2hex() 函数把包含数据的二进制字符串转换为十六进制值

```php
$str = random_bytes(5);

vardump(bin2hex($str));
```

示例 -- string(10) "3613051066"

- openssl_random_pseudo_bytes()  生成一个伪随机字节串

```php
$str = openssl_random_pseudo_bytes(5,$cstrong);
var_dump($cstrong);
var_dump(bin2hex($str));
```

- mt_rand()  生成更好的随机数


- uniqid()  获取一个带前缀、基于当前时间微秒数的唯一ID

```php
参数一：为空生成13位的唯一ID

参数二：是true | false 为true 生成23位的唯一ID

$str = uniqid('UN_',true);
var_dump($str);
```

- crypt()  单向字符串散列

- password_hash()  创建密码的散列（hash）
