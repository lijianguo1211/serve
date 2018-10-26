###laravel使用stmp驱动发送邮件

* 配置 .env 文件
* 生成邮件控制器类
* 发送邮件

#### .env文件的配置
~~~
MAIL_DRIVER=smtp//代表驱动
#MAIL_HOST=smtp.163.com
MAIL_HOST=smtp.qq.com//代表使用qq
MAIL_PORT=465//端口号
#MAIL_USERNAME=risesli@163.com
#MAIL_FROM_ADDRESS=risesli@163.com
MAIL_USERNAME=1539853340@qq.com//发送邮件的登录用户名
MAIL_FROM_ADDRESS=1539853340@qq.com//发送邮件的地址
MAIL_FROM_NAME=LiYi//发送邮件的名字
#MAIL_PASSWORD=1211060911gyz520
MAIL_PASSWORD=pocpgjaldmaybafb//qq生成的授权码
MAIL_ENCRYPTION=ssl//加密协议类型
~~~

####config文件下的mail.php配置文件

-里面需要的配置都是env里面的配置参数-

```
return = [
        'driver' => env('MAIL_DRIVER', 'smtp'),
        'host' => env('MAIL_HOST', 'smtp.163.com'),
        'port' => env('MAIL_PORT', 465),
        'from' => [
                'address' => env('MAIL_FROM_ADDRESS', 'risesli@163.com'),
                'name' => env('MAIL_FROM_NAME', 'Example'),
            ],
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD')
];

```

####生成邮件类发送邮件
`php artisan make:controller Admin/MailController`

####引入邮件类
`use Illuminate\Mail\Mailer;`

####编写构造方法
```php
class MailController
{
    private $email;
    
    public function __construct(Mailer $mailer)
        {
            $this->email = $mailer;
        }
        
    /*
    发送文本邮件
    */
    public function send()
    {
        $emailData = [
            'content' => '邮件内容',
            'subject' => '邮件主题',
            'addr'    => '发送邮件地址'
        ];
        $this->email->raw($emailData['content'],function ($message)use ($emailData){
                $message->subject($emailData['subject']);
                $message->to($emailData['addr']);
            });
    }
}
```


