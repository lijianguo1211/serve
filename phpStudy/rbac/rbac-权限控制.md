### rbac 权限控制

```mysql
-- 用户表
drop table if exists users;

create table if not exists users(
`id` int primary key auto_increment,
`name` varchar(30) not null unique,
`password` char(60) not null,
`email` varchar(30) unique,
`login_ip` varchar(10),
`login_time` int
)engine=innodb charset=utf8;

-- 角色表

```
