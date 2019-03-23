## 执行计划,这个里面我们会分析一下`mysql`的优化

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
