## psql 安装准备

配置文件所在位置，数据源 `data` 目录下，`postgresql.conf` 

```smartyconfig
#测试环境下修改监听的IP为 * ，就是所有的主机皆可连接
listen_addresses = '*'

#监听的端口可以自己修改，默认为 5432
port = 5432

#日志相关的参数

#日志收集
logging_collector = on

#日志目录
log_directory = 'pg_log'

#配置日志方案选择

#一：每天生成一个新的日志文件
log_filename = 'postgresql-%Y-%m-%d_%H%M%S.log'
log_truncate_on_rotation = off
log_rotation_age = 1d
log_rotation_size = 0

#二：按大小分类，当一个文件达到某个临界值时，创建写入下一个文件
log_filename = 'postgresql-%Y-%m-%d_%H%M%S.log'
log_truncate_on_rotation = off
log_rotation_age = 0
log_rotation_size = 10M

#三：按周期固定循环
log_filename = 'postgresql-%a.log'
log_truncate_on_rotation = on
log_rotation_age = 1d
log_rotation_size = 0

#内存参数配置

#共享内存大小，主要用于内存块
shared_buffers = 128MB

#单个SQL执行时，排序，hash join 所使用的内存，SQL执行完成之后，内存就会释放，这个值设置的越大，排序越快
work_mem = 4MB	

# 以上两个参数的值设置，是按照自己的机器配置来设置，尽量合适

```
