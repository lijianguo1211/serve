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

drop table if exists roles;

create table if not exists roels(
`id` int primary key auto_increment,
`role_name` varchar(20) unique comment '角色名，中文',
'role_title' varchar(30),
'create_time' int 
)engine=innodb charset=utf8;

-- 角色用户表
drop table if exists user_role;

create table if not exists user_role (
`user_id` int,
'role_id' int
) engine=innodb charset=utf8;

```
