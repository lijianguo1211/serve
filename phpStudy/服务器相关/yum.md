### yum 相关操作

**yum的安装软件相关操作其实就和我们的rpm 操作差不多，它们都是下载 .rpm包进行安装**

yum install ***[包名] 它就是不用我们下载相关的包进行操作，就和我们之前的傻瓜相机操作差不多，一键式的，什么都OK了。

rpm 安装包操作呢，其实就是我们自己先下载相关的rpm包，然后加入相关的参数进行操作

但是它们的本质上就是操作 .rpm 包

例如：我们想要给项目安装rabbitmq服务

- 第一步：下载rabbitmq和erlang这两个.rpm 包【rabbitmq依赖erlang】

- 第二步：安装 erlang `rpm -ivh erlang.rpm`

- 第三步：安装rabbitmq `rpm -ivh rabbitmq.rpm`

- 第四步：设置rabbitmq 服务 `chkconfig --level 2345 rabbit-server on`

**对rpm 参数做简要说明：**

```
-i 显示套件的相关信息

-h 套件安装时列出所以标记

-v 显示指令执行过程

-vv 更加详细的执行过程，便于排错

-q 使用询问模式，当遇到任何问题的时候，rpm首先询问用户

-l 显示套件的文件列表

--version 显示rpm 版本信息

--help 在线帮助
```

**对chkconfig 参数说明：[命令用于检查，设置系统的各种服务]**

```
chkconfig [--add][--del][--list][系统服务] 或 chkconfig [--level <等级代号>][系统服务][on/off/reset]

--add 增加所指定的服务，让chkconfig指令得以管理它，并同时在系统启动的叙述文件内增加相关数据。

--del 删除所指定的服务

--list 列出chkconfig所知道的所有服务情况

--level 等级代号，指定读系统服务要在哪一个执行等级中开启或关毕。
```

**yum 常用命令：**

- `yum check-update` 列出所有可以更新的安装包

- `yum update` 更新所有的安装包

- `yum install **[包名]` 安装指定的包

- `yum update **[包名]` 更新指定的包

- `yum list` 列出所有可安装的包

- `yum remove **[包名]` 移除指定的包

- `yum search **[包名]` 搜索指定的包

- `yum clear packages` 清除缓存目录下的软件包

- `yum clean headers` 清除缓存目录下的 headers

- `yum clean oldheaders` 清除缓存目录下旧的 headers

- `yum clean, yum clean all (= yum clean packages; yum clean oldheaders)` 清除缓存目录下的软件包及旧的headers


**修改yum源 **

- 进入centos7源所在的文件 `cd /etc/yum.repos.d`

- 备份系统源 `mv CentOS-Base.repo CentOS-Base.repo.bak`

- 下载网易的源 `wget http://mirrors.163.com/.help/CentOS6-Base-163.repo`

- 修改网易源的名字 `mv CentOS6-Base-163.repo CentOS-Base.repo`

- 清楚以前源的缓存 `yum clear all`

- 生成现在源的缓存 `yum makecache`