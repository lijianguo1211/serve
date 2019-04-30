use `laravel`;
drop table if exists `failed_jobs`;
create table if not exists `failed_jobs`(
`id` int primary key auto_increment comment '主键',
`connection` varchar(50)  comment '要添加的数据驱动',
`queue` varchar(50) comment '队列名',
`payload` text comment '连接的具体信息',
`failed_at` TIMESTAMP comment '发生错误的时间'
)engine=innodb charset=utf8 comment '队列错误日志记录表';



-- ---------------------------------------------------------
use `laravel`;
drop table if exists `admin_users`;
create table if not exists `admin_users`(
`id` int primary key auto_increment comment '主键',
`username` varchar(50) not null comment '用户名',
`nick_name` varchar(50) unique not null comment '账户',
`password` char(60) not null comment '密码',
`token` varchar(60) not null comment 'token',
`email` varchar(30) not null comment '邮箱',
`mobile` varchar(15) not null default '86+' comment '手机号',
`QQ` varchar(20) not null default 'qq' comment 'QQ账户',
`github` varchar(20) not null default 'github' comment 'github账户',
`type` tinyint(1) not null default 1 comment '1-web注册用户，2-github,3-qq,4-微信，5-微博',
`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '创建时间',
`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '修改时间'
)engine=innodb charset=utf8mb4 comment '用户表';
