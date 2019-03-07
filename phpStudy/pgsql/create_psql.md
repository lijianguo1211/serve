#### **创建表时对字段的约束**

* 非空 `not null`
* 唯一 `unique`
* 检查 `check`
* 主键 `primary key`
* 外键 `references`


#### **修改表**

* 增加字段
* 删除字段
* 增加约束
* 删除约束
* 修改默认值
* 修改字段类型
* 重命名字段
* 重命名表

创建一张表

```postgresplsql
drop table if exists test.users;

create table if not exists test.users(
id serial primary key unique,
email varchar(20) not null
);
```

增加一个字段,varchar()类型，不允许为空，默认值为‘0000000000’

```postgresplsql
alter table test.users add column users_qq varchar(12) not null default '00000000000';

insert into test.users(id,email) values (1,'153985@qq.com');

```

删除一个字段

```postgresplsql
alter table test.users add column created_at int;

alter table test.user drop column created_at;

alter table test.users add column age int;

```

增加约束

```postgresplsql
-- 添加检查约束 不能大于120
alter table test.users add check (age<120);

-- 添加唯一约束
alter table test.users add constraint unique_users_age unique (age);

-- 非空约束 设置not null 的字段，字段里如果有null值填充，会设置失败
alter table test.users alter column age set not null;

```

删除约束

```postgresplsql
-- 删除约束需要知道约束的名称，如下，unique_users_age 就是唯一约束的名称
alter table test.users drop constraint unique_users_age;

-- 删除非空约束
alter table test.users alter column age drop not null;

```

修改默认值

```postgresplsql
alter table test.users alter column age set default 15;
```

删除默认值

```postgresplsql
alter table test.users alter column age drop default;
```

修改字段数据类型

```postgresplsql
-- 修改的时候要注意类型
alter table test.users add column numss char(2);

alter table test.users alter column numss type varchar(15);

```

修改字段

```postgresplsql
alter table test.users rename column numss to numse;
```

重命名表

```postgresplsql
-- 报错
alter table test.users rename to test.userss;

/*
[Err] ERROR:  syntax error at or near "."
LINE 1: alter table test.users rename to test.userss;
                                             ^
 */

-- 要修改的表名不要带模式
alter table test.users rename to userss;
```


#### **创建索引**

索引分类

* B-Tree  最常用的索引 [< > <= >= =] 等值和范围查询
* Hash    只能处理最简单的等值查询
* GiST
* SP-GiST  空间分区索引
* GIN  反转索引

创建索引语法

`create 索引类型[index unique concurrently] 索引名 on 表名 (要添加索引的字段名);`

创建一个简单的`B-tree`索引

```postgresplsql
-- 默认
create index users_email_index on test.users (email);

-- 按降序创建索引
create index users_email_index on test.users (email desc);

--如果索引字段有空值，让空值排在非空值前面
create index users_email_index on test.users (email desc nulls first);

-- 反之
create index users_emial_index on test.users (email desc nulls last);

```

删除索引

```postgresplsql
drop index if exists user_email_index;

-- 强制删除索引，并且把索引的外部依赖项一起删除【比如外键依赖】
drop index if exists user_email_index cascade;

```


#### **创建用户**

```postgresplsql
-- 创建一个叫test的用户，密码是123456;并且是一个只读的用户

revoke create on schema public from public;
create user test with password '123456';

--给权限select
grant select on all tables in schema public to test;

-- 后面创建的表，test还没有权限，此时在给权限
alter default privileges in schema public grant select on tables to test;

-- 给除了schema 下的public之外的权限
grant select on all tables in schema other_schema to test;
alter default privileges in schema other_schema grant select on tables to test;

```
