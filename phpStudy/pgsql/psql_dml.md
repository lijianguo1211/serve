## 插入，更新，删除语句

- 插入语句

```postgresplsql
insert into students values ('LiYi',99,99,'2019-2-13 14:53:12');

insert into students (students_name,chinese_score,meath_score,create_at) values ('LiEr',100,100,'2019-2-13 14:53:12');

```

- 更新语句

```postgresplsql

-- 更新表中所有学生的语文成绩为120

update students set chinese_score = 120;

-- 更新指定的学生
update students set meath_score = 150 where students_name = 'LiEr';

```

- 删除语句

```postgresplsql

-- 删除学生表中ID为1的学生

delete from students where id = 1;

-- 删除整张表

delete from students;

```

- 对于删除大量的SQL语句，还可以使用 `truncate`

`delete | truncate` 都可以删除，`delete`相当于是逐条删除，而`truncate`就像是重新定义了表语句，把原来的数据全部丢弃
执行效率上来看，高于前者



