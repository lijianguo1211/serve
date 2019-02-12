## PHP实现爬虫

**主要函数**

- file_get_contents — 将整个文件读入一个字符串

- preg_match_all — 执行一个全局正则表达式匹配

    pattern
    要搜索的模式，字符串形式。
    
    subject
    输入字符串。
    
    matches
    多维数组，作为输出参数输出所有匹配结果, 数组排序通过flags指定。
    
    flags
    可以结合下面标记使用(注意不能同时使用PREG_PATTERN_ORDER和 PREG_SET_ORDER)：
    
    PREG_PATTERN_ORDER
    结果排序为$matches[0]保存完整模式的所有匹配, $matches[1] 保存第一个子组的所有匹配，以此类推。

- strpos — 查找字符串首次出现的位置
