## 快捷命令

- 登录数据库

`psql -h 192.168.0.13 -p 5432 -U mr -d tzdata`

- 查看所有数据库 `\l`

- 查看所有表 `\d`

- 查看表的定义语句 `\d table_name`

- 查看表索引 `\di table_name`

- 查看表视图 `\dv table_name`

- 查看表序列 `\ds table_name`

- 显示函数 `\df`

- 查看SQL 执行时间 `\timing on` 后面跟上要执行的SQL语句

- 查看所有表的空间 `\db`

- 查看用户或者用户组 `\du | \dg`

- 执行外部的SQL语句 `-i fileName`
