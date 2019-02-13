## 数据查询

- 查询语句

```postgresplsql

-- 查询整张学生表

select * from students;

-- 查询指定的列

select id,students_name from students;

```

- 过滤条件的查询

where 后面的条件可以是 `=`,`>`,`>=`,`<`,`<=`

模糊查询，可以是 `like` + `% | _`

多条件查询可以是 `and | or | in | between`

```postgresplsql
select * from students where id > 2;

select * from students where chinese_score = 120;

```

- 排序选择

排序选择，可以正序和倒叙 `asc | desc`

```postgresplsql
select * from students order by create_at desc;
```

- 分组选择

关键字 `group by`,使用它时要和聚合函数配合使用

- 多表联查

关键在 `join`

- 多表联合 

关键字 `union | union all`

`ubion` 联合起来重复语句会合并为一条，不想合并就是使用 `ubion all`


