### laravel项目部署

- 权限问题

1. 在根目录下的三个文件`public`,`storage`,`bootstrap`

项目的环境如果是lnmp或者lnpp,这个时候我们首先在我们的项目根目录外面修改项目的所有者，我们给的是NGINX

```php
chown -R nginx:nginx laravel
```

然后给上面列出来的三个文件权限【读写权限】

```php
chmod -R 771 [文件名]
```
