use liyi;

drop table if exists users;

create table if not exists users(
`id` int unsigned primary key auto_increment comment '主键',
`username` varchar(25) UNIQUE not null comment '用户名',
`password` varchar(128) not null comment '密码',
`email` varchar(25) UNIQUE not null comment '邮件',
`phone` varchar(20) unique not null comment '手机',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '用户表';


drop table if exists user_details;

create table if not exists user_details(
`id` int unsigned primary key auto_increment comment '主键',
`user_id` int unsigned not null comment '用户表主键',
`nick_name` varchar(30) not null default 'liyi' comment '昵称'
)ENGINE=innodb default charset=utf8 comment '用户详情表';

drop table if exists image;

create table if not exists image(
`id` int unsigned primary key auto_increment comment '主键',
`image_path` varchar(255) not null comment '图片存储路径',
`user_id` int not null comment '用户ID',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '图片存储表';

drop table if exists blogs;

create table if not exists blogs(
`id` int UNSIGNED primary key auto_increment comment '主键',
`title` varchar(20) not null comment '文章标题',
`info` varchar(255) not null comment '简介',
`label` int not null comment '文章分类',
`user_id` int not null comment '文章作者',
`reading_volume` int not null default 0 comment '阅读量',
`delete_status` tinyint(1) not null default 0 comment '是否删除，默认0，未删除',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '文章表';

drop table if exists blog_content;

create table if not exists blog_content(
`id` int  UNSIGNED primary key auto_increment comment '主键',
`types_id` int not null comment 'blog表主键',
`type` tinyint(1) not null default 0 comment '类型选择，0代表文章，1代表图片内容描述，2代表心情',
`content` text not null comment '内容'
)ENGINE=innodb default charset=utf8 comment '文章表内容';


drop table if exists headers;

create table if not exists headers(
`id` int primary key auto_increment comment '主键',
`title` varchar(10) not null comment '标题',
`url` varchar(20) not null comment '标题URL',
`priority` tinyint(2) not null default 0 comment '优先级显示，默认是0，优先级越大，优先显示',
`type` tinyint(1) not null default 0 comment '分类标记，是头标题还是右侧标题，默认是头',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '网站头显示';


drop table if exists right_tops;

create table if not exists right_tops(
`id` int PRIMARY key auto_increment comment '主键',
`title` varchar(20) not null comment '主题',
`content` varchar(255) not null comment '填充内容',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '网站又边提示';


drop table if exists types;

create table if not exists types(
`id` int PRIMARY key auto_increment comment '主键',
`pid` int not null default 0 comment '分类标签父ID',
`name` varchar(15) not null default '道' comment '标签名',
`created_at` TIMESTAMP not null comment '创建时间',
`updated_at` timestamp not null comment '修改时间'
)ENGINE=innodb default charset=utf8 comment '分类表';

