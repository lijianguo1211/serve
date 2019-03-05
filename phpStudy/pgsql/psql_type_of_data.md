## psql 数据类型了解

- 布尔类型
   
   `boolean` 值是 `false | true` 一字节

- 数值类型
    
    整型
    
     2字节`smallint`
     4字节`int`
     8字节`bigint`
     十进制精确类`numeric`
    
    浮点型
        
     `real | double | precision` 
    
    货币
      
    8字节`money`

- 字符类型
    
    有 `varchar() | char() | text` varchar()类型可以最大存储1GB

- 二进制数据类型 `bytea`

- 位串类型

    `bit(n) | bit varying(n)`

- 日期时间类型

    `date | time | timestamp`

- 枚举类型

- 几何类型

    `point | line | lseg | path | polygon | cycle`

- 网络类型

    `cidr | inet | macaddr`

- 数组类型

- 符合类型

- xml类型

- json类型

- range类型

- 对象标识符类型

--------------------

- 类型转换

可以在输入时先指定

```postgresplsql
select int '1';
```

可以手动转换,使用函数 `cast('输入值' as '要转换的类型')`

```postgresplsql
select cast('5' as int2),cast('2019-02-13' as date);
```

更加简单的双冒号转换 `'输入值 ::'要转换的类型'`

```postgresplsql
select '5' ::int2,'2019-02-13' ::date;
```

- psql 的快捷命令

`\db` 所有的表空间

`\dg | \du` 所有的用户或角色

`\dp | \z` 所有表的权限分配

`\x` 所有的数据按行展示

- psql 序列类型字段

`serial | begserial` 序列自增

postgresql 其实是有自己的序列自增类型的 `sequence`

创建表自增主键的时候可以用到 --》

```postgresplsql
create sequence test_id_seq;

create table test(
id integer not null default nextval('test_id_seq')
);

```

- 字符串操作函数

* 字符串连接 `||` ==> `str1||str2  ==> select 'aa'||'bb'`

* 字符串的字符个数 `char_length` ==> `char_length('qwe')`

* 字符串转大写 `upper`  ==> `upper('abc')`

* 字符串转小写 `lower` ==> `lower('ABC')`

* 得到ascll码的字符 `chr` ==> `chr(100)`

* 编码 `encode('string',type=[base64,hex,escape])`

* 解码 `decode('string',type=[base64,hex,escape])`

* 首字母大写 `initcap()`

* 得到字符串长度 `length()`

* md5加密字符串 `md5()`

* 得到当前客户端的编码名称 `pg_clint_encoding()`


