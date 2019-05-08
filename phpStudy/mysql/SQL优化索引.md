### SQL索引思路


我所了解到索引--》

索引一般分为：
* 主键索引 `primary key`
* 普通索引 `index`
* 唯一索引 `unique`

主键索引：一般是在创建表的时候，习惯性的为每一张表定义一个主键ID，`primary key`。数据类型定义为`int`。然后再让它自增就OK了。它一般也是使用的最多的。
前面已经知道，对于`mysql`的默认引擎`innodb`来说，它的数据和索引都在一起。如果是`myisam`引擎来说，又是不一样的。它的索引是一个文件，数据区是另外一个
文件。假如两张表一样。

```mysql
drop table if exists u1;

create table if not exists u1(
`id` int unsigned primary key auto_increment comment '主键',
`username` char(6) UNIQUE not null comment '用户名',
`password` char(32) not null comment '密码',
`email` varchar(30) UNIQUE not null comment '邮件',
`phone` char(11) unique not null comment '手机',
`created_at` int not null comment '创建时间'
)ENGINE=INNODB default charset=utf8mb4 comment '用户表';

drop table if exists u2;

create table if not exists u2(
`id` int unsigned primary key auto_increment comment '主键',
`username` char(6) UNIQUE not null comment '用户名',
`password` char(32) not null comment '密码',
`email` varchar(30) UNIQUE not null comment '邮件',
`phone` varchar(11) unique not null comment '手机',
`created_at` int not null comment '创建时间'
)ENGINE=myisam default charset=utf8mb4 comment '用户表';
```

现在向里面添加各自添加2000条数据。这两张表各自有一个主键索引，三个唯一索引。表u1是`innodb` 表u2是`myisam`。现在运行：

```mysql
# 0.02658200 | select * from u1 order by email desc
# 0.00612325 | select * from u2 order by email desc
```
然后分析发现：唯一索引在排序时是没有用到的,不管是什么引擎都是全表扫描

```mysql

# mysql> explain select * from u2 order by email desc \G
# *************************** 1. row ***************************
#           id: 1
#  select_type: SIMPLE
#        table: u2
#   partitions: NULL
#         type: ALL
# possible_keys: NULL
#          key: NULL
#      key_len: NULL
#          ref: NULL
#         rows: 2000
#     filtered: 100.00
#        Extra: Using filesort
# 1 row in set, 1 warning (0.00 sec)

# mysql> explain select * from u1 order by email desc \G
# *************************** 1. row ***************************
#           id: 1
#  select_type: SIMPLE
#        table: u1
#   partitions: NULL
#         type: ALL
# possible_keys: NULL
#          key: NULL
#      key_len: NULL
#          ref: NULL
#         rows: 2000
#     filtered: 100.00
#        Extra: Using filesort
# 1 row in set, 1 warning (0.00 sec)
```

这次我们运行一个是查询有主键索引的数据，看看结果怎么样：

```mysql
#|       12 | 0.00111450 | select id,email,username,phone from u2 where id>1200 order by id desc
#|       13 | 0.00142025 | select id,email,username,phone from u1 where id>1200 order by id desc
```
最后得到的结果：使用`innodb`引擎的表，确实用到了索引，而且是range.`myisam`没有用到索引，但是它的查询速度却比`innodb`快

```mysql
# mysql>  explain select id,email,username,phone from u1 where id>1200 order by id desc \G
# *************************** 1. row ***************************
#            id: 1
#   select_type: SIMPLE
#         table: u1
#    partitions: NULL
#          type: range
# possible_keys: PRIMARY
#           key: PRIMARY
#       key_len: 4
#           ref: NULL
#          rows: 800
#      filtered: 100.00
#         Extra: Using where
# 1 row in set, 1 warning (0.00 sec)

# mysql>  explain select id,email,username,phone from u2 where id>1200 order by id desc \G
# *************************** 1. row ***************************
#            id: 1
#   select_type: SIMPLE
#         table: u2
#    partitions: NULL
#          type: ALL
# possible_keys: PRIMARY
#           key: NULL
#       key_len: NULL
#           ref: NULL
#          rows: 2000
#      filtered: 41.20
#         Extra: Using where; Using filesort
# 1 row in set, 1 warning (0.00 sec)
```

针对上面发现的问题，我们这里又要引入两个词：
* 聚集索引 mysql中的代表--`innodb` 数据行的物理顺序与列值（一般是主键的那一列）的逻辑顺序相同
* 非聚集索引 mysql中的代表--`myisam`  数据存储在一个地方，索引存储在另一个地方，索引带有指针指向数据的存储位置。














































