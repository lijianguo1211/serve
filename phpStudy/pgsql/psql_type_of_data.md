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


