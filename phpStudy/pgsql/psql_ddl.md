## 数据定义语言，创建，删除，修改表，索引，等数据库对象语言

- 简单创建表

```postgresplsql

-- 创建一个学生表，有学生姓名，语文成绩，数学成绩，填写时间，表的ID，创建主键可以用 primary key 指定

create table students (
id int primary key,
student_name varchar(30),
chinese_score int,
meath_score int,
create_at date
);

```
命令行运行上述语句之后，可以使用 `\d`,查看有哪些表

`\d table_name` 可以查看表的定义情况

- 删除表 

```postgresplsql
drop table sttudents;
```
