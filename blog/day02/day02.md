### 上班第二天

2019-05-16 今天天气比昨天要稍微好点，每天还是拴着的陀螺，按时醒来，起床洗漱，今天还好只是毛毛雨，所以可以起来提前吃点早点，
昨晚提前买好的面包，如果早晨可以买点牛奶，喝点热牛奶，吃点小面包，就非常完美了，加油。

上午还是熟悉环境，还有就是社保类的事情，还好就是我的社保卡，还好我的社保卡是之前在武汉办的，所以我的就是续交就可以了。

下午还好就是熟悉git的提交流程。目前的这家公司的git的流程是：

1. 首先是确定工作的目的，是功能添加，还是bug修改。这些基于`master`的创建新的分支：

```git
git checkout -b feature-function-jayli master
```

2. 功能添加例子：

```git
<?php
class Mysql
{
    private static $instance = null;

    private function __construct()
    {
        self::$instance = new PDO("mysql:host=;port=;dbname=",'','');
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
?>
```

2.1 查看修改的文件 `git status`

2.2 添加到缓存区 `git add .`

2.3 添加修改内容备注 `git commit -m 'mysql单利模式'`

3. 切换到测试分支。

```git
git checkout develop
```

3.1 拉取云端上的develop分支代码

```git
git fetch origin develop
```

3.2 合并develop的代码

```git
git merge origin/develop
```

3.3 合并功能代码到测试分支代码

```git
git merge feature-function-jayli
```

3.5 推送合并的分支到云端

```git
git push origin develop
```

这些基本上就是现在git的工作流程。还有就是第二件事儿每个人配置一台虚拟主机，把目前的环境放到liunx中去。就是这个环境几乎折磨我了一下午，这还是之前有一
点liunx基础的情况下。

在liunx环境中，我们需要做到的就是第一安装`node`环境，第二安装`git`环境，第三安装`php`的环境，第四安装`apache`的环境，唯一的不好就是配置各自的配
置文件，在`apache`中添加`PHP`模块，配置项目的虚拟机。遇到的问题就是`apache`不解析PHP的文件，导致访问php的文件按的时候，不是解析显示，而是下载我的
php文件，最终找到的问题就是有两点需要注意：

1. 安装完成之后，需要修改apache的配置文件。一般就是在`/usr/local/apache/conf/httpd.conf`,在这个文件里需要添加php模块，

2. 还是在主配置文件里，我们需要添加，apache对php结尾文件的解析支持

3. 添加一个apache的监听端口。监听所有的IP，但是要做到端口的确定。

4. 配置虚拟主机，这个是在`vhost/*.conf`文件下面，做一个监听端口，一个虚拟域名，一个指向项目的根目录，一个属于html,php的解析索引。

5. 配置的虚拟域名，所以需要在Windows上的host文件做一个域名与127.0.0.1的索引绑定


**************

加油！ JayLi