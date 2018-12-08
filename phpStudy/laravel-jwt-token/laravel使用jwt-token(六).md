## **laravel使用jwt-token（六）**

在第五‘骗’学习中我们了解了几个jwt的常用方法，其实这些方法我们没必要去死记硬背，我们只要知道它在哪里，
以及它在那里是怎么实现的。那么我们再次来理解的时候就轻松多了

我们首先找到源码位置`tymon/jwt-auth/JWT.php`

#### **1. 在这里我们可以看到它定义了四个受保护的变量**
- `protected $manager;`
- `protected $parser;`
- `protected $token;`
- `protected $lockSubject = true;`
一个一个来说
第一个$manager,它就好像是一个|身份验证管理器，实现地址`\Tymon\JWTAuth\Manager`
第二个$parser,http解析器，实现地址 `\Tymon\JWTAuth\Http\Parser\Parser`
第三个$token,就是我们的令牌
第四个$lockSubject,这个变量是有默认值的，默认是true，是锁定主题的

#### **2.构造方法**
```php
public function __construct(Manager $manager, Parser $parser)
    {
        $this->manager = $manager;
        $this->parser = $parser;
    }
```
就是实例化上面说的两个类；

#### **3.下面就是我们可以使用的方法了**

    3.1.a `public function fromSubject(JWTSubject $subject){}`;
    
    3.1.b `public function fromUser(JWTSubject $user){}`

【3.1.a和3.1.b】这两个方法其实最后得到的结果是一样的，都是得到令牌，只不过fromUser()是fromSubject()的别名

    3.2 `public function refresh($forceForever = false, $resetClaims = false){}`
【3.2 就是我们之前使用过的刷新令牌】

    3.3 `public function invalidate($forceForever = false){}`
【3.3 就是让我们的令牌失效】

    3.4 `public function checkOrFail(){}`
【3.4 获得有效荷载，检查令牌是否有效】

    3.5 `public function check($getPayload = false){}`
【3.5 检查用户是否登录】

    3.6 `public function getToken(){}`
【3.6 得到令牌】

    3.7 `public function parseToken(){}`
【3.7 从请求中解析令牌】
    
    3.8 ` public function getPayload(){}`
【3.8 获取原始有效荷载实例】
    
    3.9 `public function payload(){}`
【3.9 它是getPlayload的别名，功能都是一样的】

    3.9.A `public function getClaim($claim){}`
【3.9.A 得到荷载中具体的值】

    3.9.B `public function makePayload(JWTSubject $subject){}`
【3.9.B 创造有效荷载的实例】

    3.9.C `public function blacklist(){}`
【3.9.C 得到黑名单】

    3.9.D `protected function requireToken(){}`
【3.9.D 确保令牌可用】

    3.9.E `public function unsetToken(){}`
【3.9.E 销毁令牌】

以上这些基本就够我们用了，应该说常用的就是这些了，这里面还有很多方法我没有列举出来，我也没有用过，不知道它具体是做什么用的