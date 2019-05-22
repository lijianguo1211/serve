### git 常用的命令

* 拉取线上代码

```git
git clone https://github.com/lijianguo1211/serve/tree/liyi
```

* 查看当前本地当前分支

```git
git branch
```

* 查看本地和线上的分支

```git
git branch -a
```

* 查看线上分支

```git
git branch -r
```

* 查看本地分支和线上分支的映射关系

```git
git branch --v
```

* 切换分支

```git
git checkout admin_dev
```

* 切换分支并且新建分支

```git
git checkout -b test
```

* 通俗的拉取代码

```git
git pull
```

* 通俗的推送代码

```git
git push
```

> ps 这两个通俗的拉取推送代码，前提是本地代码已经和线上的代码库已经建立了映射关系

* 本地新建分支推送到代码库

```git
git push origin test
```

* 本地分支和代码库分支建立映射关系,本地test分支与线上liyi分支建立映射关系

```git
git branch --set-upstream-to=origin/liyi test
```

* 拉取线上代码

```git
git fetch origin liyi
```

* 把代码库分支liyi的代码合并到本地的test分支上,前提是已经在test分支上

```git
git merge origin/liyi
```

* 把本地代码存放到缓存区

```git
git add .
```

* 为本次提交添加注释

```git
git commit -m '测试文件'
```

* 把本次代码提交到远程代码库

```git
git push origin liyi
```

* 查看本次文件的变动

```git 
git status
```

* 本次修改的代码，不想提交到缓存区，不想`git add . | git commit -m ''`,就像切换分支，可以把代码放到暂存区

```git
git stash
```

> ps 再去用`git status`看我们变动的文件，发现已经没有修改了。而且已经回到了我们没有做修改之前了，也就是我们最近一次提交代码的位置了。

* 把暂存区的代码恢复，恢复当前已经修改的文件，这个时候，可以看到，修改的文件又到了修改过的样子。

```git 
//恢复最近保存的记录并把恢复的记录从保存列表中删除。只恢复工作区！（默认会将被恢复的操作保留在工作区，但是不会自动帮你重新暂存）
git stash pop
```

> ps 注意恢复暂存的几个命令的不同，

```git
//恢复最近保存的记录但不会删除保存列表里面对应的记录。（默认会将被恢复的操作保留在工作区，但是不会自动帮你重新暂存）
git stash appay
```

**********************

### git 一般工作流程

* 主分支 `origin/master`

* 测试环境分支 `origin/develop`

* 功能代码分支 `origin/feature-function-liyi`

一般，在做新功能的开发或者是bug修改的时候，是我们先在`master`分支上新建一个功能分支

1. 查看当前本地分支，是否在master分支，不在，切换到`master`分支

```git
git brnach 

git checkout master
```

2. 现在已经在`master`分支了，基于`master`分支新建一个功能分支

```git
git cheeckout -b feature-function-liyi
```

3. 在新建的本地分支上做开发，然后提交

```git
git add .

git commit -m ''
```

4. 新开发的功能已经完善，把新功能的分支合并到测试分支`develop`

a. 切换到`develop`分支

```git
git checkout develop
```

b. 拉取代码库里`develop`的分支

```git
git fetch origin develop
```

c. 合并代码库的`develop`分支到本地`develop`分支

```git
git merge origin/develop
```

d. 合并新开发在功能分支到`develop`分支

```git
git merge feature-function-liyi
```

e. 推送合并请求

```git
git push origin develop
```

e. 等待合并

f. 测试代码完成，重复上述过程，把功能分支推送到线上`master`分支。

g. 工作告一段落。




