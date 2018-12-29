### liunx-centos上redis的安装测试

- 下载redis
[redis官方网站下载地址](https://redis.io/download)

- 在centos上编译安装
    
  1. 下载 `wget http://download.redis.io/releases/redis-5.0.3.tar.gz`
  2. 解压 `tar xzf redis-5.0.3.tar.gz`
  3. 进入redis目录 `cd redis-5.0.3`
  4. 编译 `make`
  5. 安装 `make install`
  
- 安装完成之后测试`redis`是否可以启动

   1. `cd src` 然后输入启动命令 `redis-server`
   
   成功如下：
   
   ![redis 启动成功](redis-test1.png)
   
   2. 
   
   3. 重新打开一个终端，这个终端不要关，然后用绝对路径输入命令 `/home/redis-5.0.3/src/redis-cli`;【这个路径是看你们在那个位置安装的，不要和我的一样】
   
   接下来可以看到：
   
   ![redis 测试](redis-test2.png)
   
现在我们的redis已经安装成功了，不过缺点是，前面的我们那个终端不能关，要一直打开，这可不行，所以我们要让它开机自启，以及给它配备一些我们容易记住的命令【启动，停止】

- 进入我们的redis的安装目录，`cd /home/redis-5.0.3/utils` 可以看到`redis_init_script`它，对就是它，它就是官方已经为我们准备好的启动，停止脚本。
  
  1. 复制它到我们的centos最牛逼的进程文件下。 `cp redis_init_script /etc/init.d`
  
  2. 在 `/etc/init.d/` 下修改`redis_init_script` 为 `redis` => `mv redis_init_script redis`
  
  3. 给它写的权限 `chmod +x redis`
  
  