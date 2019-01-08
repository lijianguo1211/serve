### nginx了解

web页面的访问及其资源

web页面：多个资源
入口,资源引用

认证：
    基于ip认证
    基于用户认证
        basic
        digest
资源映射：
    alias
    documentRoot

- httpd: MPM
    prefork,worker,event

    1. prefork :主进程，生成多个子进程，每个子进程处理一个请求 【复用型i/o】

    2. worker：主进程，生成多个子进程，每个主进程生成多个线程，每个线程响应一个请求 【复用型i/o】

    3. event：主进程生成多个子进程，每个子进程响应多个请求【信号驱动式i/o】

- i/o类型：调用方向被调用方发起请求

    1. 同步和异步：【synchronous  asynchronous】
       关注的是消息通信机制

        同步：调用发出之后不会立即返回，但一旦返回，则返回的是最终结果
        异步：调用发出之后，被调用方立即返回消息，但返回的不是最终结果，被调用者通过状态，通知机制等来通知被调用者，或通过函数来处理返回结果

    2. 阻塞和非阻塞：【block  nonblock】
       关注的是调用者等待被调用者返回结果时的状态

        阻塞：调用结果返回之前，调用者会被挂起，调用者只有在得到返回结果之后才能继续

        非阻塞：调用结果返回之前，调用者不会被挂起，即调用不会阻塞调用者

- i/o模型：

    1. 阻塞式i/o

    2. 非阻塞i/o

    3. 复用型i/o | 多路i/o
        select  -》 1024
            调用者 -》 select -》被调用者【内核】
        poll
    
        它们依然本质是阻塞性i/o

    4. 信号驱动式   【epoll,kqueue,/dev/poll】
        非阻塞型
        调用者非阻塞 -》 内核阻塞
        调用者发送请求 -》 内核向磁盘发送请求 -》 被调用者收到消息【该干嘛干嘛】 -》磁盘处理，发送给内核 -》 内核把消息发送给调用者，内核通知被调用者好了

        水平触发，多次通知
        边缘触发，只通知一次

    5. 异步i/o [aio]

某一个进程只能一次处理一个i/o

例如：一次read操作
1.进程通知内核要读取数据
2.等待内核返回数据
3.内核去通知磁盘读取数据
4.内核等待数据
5.磁盘把数据送到内核【内存区】
6.内核把数据复制到进程内存
7.调用者得到数据


- nginx 特性
1. 模块化设计，较好扩展性
2. 高可靠性
    master/worker
3. 支持热部署
    不停机更新配置文件，更换日志，更换服务器程序版本
4. 低内存消耗
    10000个keep-alive连接模式的非活动连接仅消耗2.5M内存
5. event-drlven,alo,mmap

- 基本功能：
    静态资源的web服务器
    http协议的反向代理服务器
    pop3,smtp,lamp4,等邮件的反向代理
    能缓存打开文件（元数据），支持fastcgi（php-fpm），cwsgi(python web framwork)等协议
    模块化（非dos机制）过滤zip，ssi,ssl

- web相关功能：
    虚拟主机，keepalive,访问日志（基于日志缓冲提高性能），url rewlrte ,路径别名，基于ip及用户的访问控制，支持速率限制和并发限制

- nginx基本架构
    1. master/worker
        一个master进程，可生成一个或多个worker进程
        事件驱动，epoll(liunx),kqueue(FreeBSD)./dev/poll（Solalrs）
        消息通知，select poll rt slgnals
        支持a/o，i/o，mmap

        master 加载配置文件，管理worker进程，平滑升级，分发任务
        worker http服务，http的代理，fastcgi的代理

    2. 模块类型
        核心模块
        Standard HTTP modules
        Optlonal HTTP modules
        mail modules
        3rd party modules

    3. 用来做什么：
        静态资源服务器
        反向代理服务器


- nginx 安装配置

    yum info nginx  查看nginx源

- 编译安装
    依赖库：Gnu pcre-devel zlib-devel openssl-devl

    wget

    tar xf

    cd nginx

    useradd -r nginx
    id nginx


    ps aux | grep nginx

    lscpu 查看cpu

- 配置文件组成部分：
    nginx.conf 主配置文件  支持include引入

    mime.types

    fastcgi相关配置  fastcgi_params

- 配置文件内容
    每个指令必须以分号结尾
    支持使用变量
        内置变量
            由模块引入
        用户自定义变量
            set varlable value;
        引用变量

- 配置文件的组织结构：
    1. main block
    2. event {...}
    3. http {
        ...
        
        server {
            ...
            
            listion
            root
            allas
            server_name
            location {
            ...
            }
        }
    }

    1.main 配置段
        
    - 类别：
    
         1. 正常必备

            1. user username groupname
            指定用于运行worker进程的用户和用户组
            2. pid /pid/path/to/pid_file
            指定nginx进程的pid文件
            3. worker_rllmlt_nofile
            指定一个worker进程所能够打开的最大文件描述数量
            4. worker——rllmlt_slgpendlng
            指定每个用户能够发往worker进程的信号质量
            
         2. 优化性能
               
            1. worker_processes
            worker进程的个数，通常应该为物理cpu核心数量减一,可以设置为auto，设置为自动设定
            2. worker_cpu_afflnlty  cpumask,cpumask,...
                cpumask;
                    0001
                    0010
                    0100
                    1000
            3. worker_prlorlty nice  数字越大优先级越低，数字越小优先级越大 【-20 ，19】
            
         3. 调试，定位问题
         
            1. daemon [off|on]
            是否以守护进程启动nginx
            2. master_process [on | off]
            是否以master/worker模型运行nginx
            3. error_log /path/to/error_log level;
            错误日志文件及其级别，出于调试的需要，可以设定为debug，debug在编译时必须添加

        2.event 配置段主要参数
         1. worker_connections
                每个worker进程所能够响应的最大并发请求数量
                    worker_processes * worker_connections
         2. use [epoll|rgslg|select|poll]      
                选择事件驱动模型
         3. accept_mutex [on | off] 【各worker接收用户的请求的负载均衡锁】
                on -> 多个worker进程能够轮流的序列化的响应新请求
         4. lock_file  /path/to/lock_file

    3. http配置段：
    
        1. 套接字或主机相关的指令：
        server{} 虚拟主机

            1. server {
                listen 8080;
                server_name www.lglg.xyz

                root /data;
            }
                注意：
                    基于port
                        listen指令监听在不同的端口
                    基于hostname
                        server_name指令指向不同的主机名

            2. listen
                default_server:设置默认虚拟主机；用于基于ip地址，或使用任意不能对应任何一个server的name时说返回的站点
                ssl:用于限制只能通过ssl连接提供服务
                spdy:spdy protocol(speedy)在编译nginx时，必须添加spdy模块
                http2: http version 2
            3. server_name name [...]
                后可跟一个或多个主机名，名称还可以使用通配符和正则表达式 (~)
                (1)首先做精确匹配 www.lglg.xyz
                (2)左侧通配符 *.lglg.xyz
                (3)右侧通配符 www.lglg.*
                (4)正则表达式 ~^.*\.lglg\.xyz$
                (5)default_server

            4. tcp_nodelay on | off;
                对keepalive模式下的连接是否启用使用 tcp_nodelay

            5. tcp_nopush on | off;
                是否启用tcp_nopush(freebse)或tcp_cork(liunx)选项，仅在sendfile为on时有用
            6. sendfile on | off;
                是否启用sendfile功能；

        2. 路径相关的指令：
            7. root
                设置web资源的路径映射；用于指明请求的url所对应的文档的目录路径
            8. location
                [ = | ~ | ~* | ^~ ] uri { ... }
                @name { ... }

                允许根据用户请求的的uri来匹配定义的location，匹配到时，次请求将被响应的location块中的配置处理，简言之，即用于为需要用到的专用配置的uri提供特定配置

                server {
                    server_name www.lglgl.xyz;
                    root /data/wwww;
                    location / {
                        root /***
                    }
                    location /admin/ {
                        ...
                    }
                }

                = :uri 精确匹配
                ~ ：做正则表达式匹配，区分字符大小写
                ~* ：做正则表达式匹配，区分字符大小写
                ^~ :uri左半部分匹配，不区分字符大小写

                server {
                    location =/ {
                        A 精确匹配
                    }

                    location / {
                        B
                    }

                    location /admin/ {
                        C
                    }

                    location ~*\.(gif|jeg|jpeg|png)$ {
                        D
                    }
                }

                匹配优先级
                    精确匹配【=】 > 左半部分匹配 【^~】 > 正则表达式 【~ 或 ~*】 > 不带符号的uri

            9. alias 定义路径的别名，只能用于location配置段。 
                   
                    server {
    
                        ...
    
                        location /image/ {
                            root /data/img/;
                        }
                        location /image/ {
                            alias /data/img/;
                        }
                    }

                **注意：**
                root指令:路径为对应的location的 “/”这个ur
                alias指令：给定的路径对应location的“uri”的这个uri

            10. index 指定首页 可以在 http server location

            11. error_page code ...[=[response]]  uri;
                根据http状态码。重定向错误页面

                error_page 404 /404.html
                error_page 404 = 200 /404.html

            12. try_files  
                try_files file ... $uri;
                try_files file ... =code
            尝试查找第一至第n-1个文件，第一个即为返回给请求者的资源，若1至n-1文件都不存在，则跳转至第一个uri(由其它location所定义，必须存在。必须不能匹配至当前的location，而应该匹配到其它location,不然会导致死循环，服务器内部错误)

        3. 客户端请求相关的配置

            13. keepalive_timeout timeout [header_timeout]
                设定keepalive连接的超时时长，默认为75S，0表示禁止长连接

            14. keepailve_request number
                在keepalive连接上所允许请求的最大资源数量，默认为100

            15. keepalive_disable none | browser ...;
                指明禁止何种浏览器使用keepalive功能

            16. send_timeout #;
                发送响应报文的超时时长，默认为60S；

            17. client_body_buffer_size size [8k | 16k]
                接受客户端请求报文body的缓冲区大小，默认16k,超出指定大小时，其将被移存于磁盘上

            18. client_body_temp_path path [level1 | level2 | level3]
                level表示级别
                设定用于存储客户端请求body的临时存储路径及子目录结构和数量；
                client_body_temp_path /var/tmp/client_body 2 2;

        4. 对客户端请求进行限制：

            19. limit_excpet method{...}
                对指定范围之外的其它的方法进行访问控制；

                    limit_excpet GET {
                        allow 129.11.11.11;
                        deny all;
                    }

            20. limit_rate speed;
                限制客户端每秒所能传输的字节数，默认0表示无限制；

        5. 文件操作优化相关的配置

            21. aio on | off;
                是否启用异步i/o

            22. dirctio size | off;    

            23. open_file_cache off;
                open_file_cache max=n [lnactlve=time]
                nginx可以缓存以下三种信息
                    文件描述符，文件大小，最近一次修改的时间
                    打开的目录结构
                    没有找到的或者没有权限操作的文件相关信息

                    max = n,表示可缓存的最大条目数上线，一旦达到上线限，则会使用lru算法从缓存中删除最近最少使用的缓存项
                    lnactlve=time 在此处指定的时长内没有被访问过的缓存项是为非法活动缓存项，因此直接删除
