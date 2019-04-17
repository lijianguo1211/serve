<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class TestController extends BaseController
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function mail()
    {
        //测试数据
        $viewData = ['title' => '你若盛开，清风自来','author' => '木心'];
        $emailData = [
            'content' => '人最难控制的，不是别人，而是自己。做人要学会自信而不要自傲，果断而不武断，自尊而不自负，严谨而不拘束，知足而不满足，平常而不平庸，随和而不随便，放松而不放纵，认真而不较真。 ​​​​',
            'subject' => '小珍珍',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        $this->sendText($emailData);
        //$this->sendHtml('mail',$viewData,$emailData);
        //TODO  $tag 判断发送是否成功，进行后续代码开发
        return view('admin/test/mail',['title' => '你若盛开，清风自来','author' => '木心']);
    }

    public function sendText($emailData)
    {
        //此处为文本内容
        $tag = $this->mailer
            ->raw($emailData['content'],
                function ($message)use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }

    /**
     * 发送自定义网页
     * @param $emailData 邮件数据
     * @param $viewPage html视图
     * @param $viewData html传输数据
     */
    public function sendHtml($viewPage,$viewData,$emailData)
    {
        $tag = $this->mailer
            ->send($viewPage,$viewData,
                function ($message) use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }

    /**
     * Notes:自定义邮件格式
     * User: "LiJinGuo"
     * Date: 2018/7/30
     * Time: 20:26
     * @return int
     */
    public function saveEmail()
    {
        $viewPage = 'admin.test.mail';
        //dd($viewPage);exit;
        $viewData = ['title' => '你若盛开，清风自来','author' => '木心','url'=>'http://img.ivsky.com/img/bizhi/slides/201805/19/solo_a_star_wars_story-002.jpg'];
        $emailData1 = [
            'content' => '人最难控制的，不是别人，而是自己。做人要学会自信而不要自傲，果断而不武断，自尊而不自负，严谨而不拘束，知足而不满足，平常而不平庸，随和而不随便，放松而不放纵，认真而不较真。 ​​​​',
            'subject' => '小珍珍',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        $emailData = [
            'subject' => '光年之外',//邮件主题
            'addr' => '270326786@qq.com',//邮件接收地址
        ];
        //$result = $this->sendText($emailData);
        $result = $this->sendHtml($viewPage,$viewData,$emailData);
        return !$result ? 123 : 321;
    }

    public function index()
    {
        return view('admin/test/mail',['title' => '你若盛开，清风自来','author' => '木心']);
    }

    public function test2()
    {
        Mail::raw('恭喜你注册成功',function($message) {//内容,回调函数
            $message->subject('提醒激活邮件');//主题
            $message->to('270326786@qq.com');//接收人
        });
    }

    //测试redis的使用
    public function testRedis()
    {
        Redis::set('names','laravel-hello-world');
        $value = Redis::get('names');
        dd($value);
    }

    public function index1()
    {
        return view('admin/admin/index');
    }

    /**
     * Notes:百度语音测试得到token
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 15:44
     * @return bool
     */
    public function index2()
    {
        $url = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=StbsLBfHfPwLUOafmopLOMPZ&client_secret=kUKK1GGA8jkBzF2r8kdDzTaqyxPDmAOR';
        $result = $this->setCurlHttp($url,'','','');
        $result = json_decode($result,true);
        if ($result['expires_in'] != 2592000) {
            return (json_last_error() == JSON_ERROR_NONE);
        }
        return $result['access_token'];
    }

    /**
     * Notes:百度语音api接口合成语音测试
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 15:45
     */
    public function index3()
    {
        $token = $this->index2();
        $tex = '我觉得完美的人生，是在少年时期就很老了，有一颗多愁善感，满是抬头纹的心，然后他慢慢长大，慢慢变得越来越年轻，年轻得像个无所畏惧的混蛋';
        $tex = urlencode($tex);
        $params = [
            'lan' => 'zh',//固定值zh。语言选择,目前只有中英文混合模式，填写固定值zh
            'ctp' => 1,//客户端类型选择，web端填写固定值1
            'tok' => $token,//开放平台获取到的开发者access_token
            'tex' => $tex,//合成的文本，使用UTF-8编码
            'per' => 4,//发音人选择, 0为普通女声，1为普通男生，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女声
            'spd' => 5,//语速，取值0-15，默认为5中语速
            'pit' => 5,//音调，取值0-15，默认为5中语调
            'aue' => 6,//3为mp3格式(默认)； 4为pcm-16k；5为pcm-8k；6为wav（内容同pcm-16k）
            'cuid' => 'StbsLBfHfPwLUOafmopLOMPZ',//用户唯一标识，用来计算UV值。建议填写能区分用户的机器 MAC 地址或 IMEI 码，长度为60字符以内
        ];
        $params = http_build_query($params);
        $url = 'https://tsn.baidu.com/text2audio?'.$params;
        $result = $this->getCurlHttps($url);
        dd($result);
    }
}
