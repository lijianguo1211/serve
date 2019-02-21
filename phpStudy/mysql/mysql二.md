## mysql 

- 优化器

- 插拔式的存储引擎--》作用于表

- 查询优化 -- 查询执行的路径

#### 
- 1.mysql 客户端和服务端通信

通信方式 【半双工--对讲机】【全双工--打电话】【单工--收音机】

mysql 是半双工

客户端一旦开始发送消息另一端要接受完整个消息才能响应

客户端一旦开始接受数据没法停下来发送指令

show processlist;/show full processlist;

sleep

query

locked

sorting result 线程正在

sending data  向请求端返回数据

- 2.查询缓存

工作原理：缓存select操作结果集的SQL语句；新的select语句,先去查询缓存，判断是否存在可用的记录集

判断标准：与缓存的SQL语句，是否完全一样

就像是一个key =>value 形式
key ==》SQL语句
value ==》 SQL查询得到的结果集

坑：
1.查询的语句要完全一样的，
2.查询的数据量太大,
3.SQL语句使用函数，
4.不涉及表的操作不会放到缓存 select 1+1;
5.只要涉及到表的修改，添加，删除，整张表的缓存到会失效

show variables like query_cache_type= 0关闭 | 1开启 | 2按需开启

show status like "Qcache%"

- 3.查询优化处理

3.1 解析SQL 
    通过lex

3.2 预处理阶段

3.3 查询优化器
    
   - 使用等价变化规则
   - 优化count min max 等函数
   - 覆盖索引扫描
   - 子查询优化
   - 提前终止查询 limit 100
   - in的优化 【全表扫描】
   select * from user where id 1 or 2 or 3;
   select * from user where id in (1,2,3);

- 4.调用执行引擎
- 5.返回客户端


## 执行计划

users;user_address;一对多的关系

ID相同，执行顺序从上到下
ID不同，如果是子查询，ID会递增，ID值越大优先级越高，ID大的先执行

select_type

system > const > eq_ref > ref > range > index > all

system 表只有一行记录

const 表示通过一次索引就找到了，const --> primary key |unique_index

eq_ref 唯一索引扫描，对于每个索引键

ref 非唯一索引扫描

range like > < 只检索给定范围的行，使用一个索引来选择行

index full index scan，索引全表扫描，把索引从头到位扫一遍

all full table scan 遍历全表以找到匹配的行


有可能用到的索引  possible_key

实际用到的索引 key

根据表统计信息或者索引选用情况，大致估算出 rows

filtered


Extra

https://www.mysql.com/products/connector/

https://dev.mysql.com/downloads/connector/j/

https://dev.mysql.com/downloads/file/?id=480090

https://mvnrepository.com/tags/maven



