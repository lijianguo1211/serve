<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Notes:http  get请求
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param $url
     * @return mixed
     */
    public function getcurl($url)
    {
        $ch = curl_init();//初始化curl
        curl_setopt($ch, CURLOPT_URL, $url);//设置url属性
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//curl_exec获取到的信息以字符串返回,不是直接输出
        curl_setopt($ch, CURLOPT_HEADER, 0);//启用时会将头文件的信息作为数据流输出。
        $output = curl_exec($ch);//获取数据
        curl_close($ch);//关闭curl
        return $output;
    }

    /** HTTPS get 请求
     * Notes:
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param $url
     * @return mixed
     */
    public function getCurlHttps($url)
    {
        $req = curl_init();//初始化curl
        curl_setopt($req,CURLOPT_URL,$url);//设置请求链接
        //设置超时时长(秒)
        curl_setopt($req, CURLOPT_TIMEOUT,3);
        //设置链接时长
        curl_setopt($req, CURLOPT_CONNECTTIMEOUT,10);
        //设置头信息
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        curl_setopt($req, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($req);
        curl_close($req);
        return $data;
    }

    /**
     * Notes:
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 14:43
     * @param        $url
     * @param        $data
     * @param null   $timeout
     * @param string $header
     * @return bool|mixed
     */
    public function setCurlHttp($url,$data,$timeout=null,$header='')
    {
        if ($url == '') {
            return false;
        }
        $timeout = $timeout === null ? 5 : intval($timeout);
        //初始化url
        $ch = curl_init();
        //设置请求连接
        curl_setopt($ch,CURLOPT_URL,$url);
        //设置超时时长
        curl_setopt($ch,CURLOPT_TIMEOUT,(int)$timeout);
        //设置连接时长
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,10);
        //CURLOPT_RETURNTRANSFER 设置为1表示稍后执行的curl_exec函数的返回是URL的返回字符串，而不是把返回字符串定向到标准输出并返回TRUE；curlopt_return_transfer
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        //CURLLOPT_HEADER设置为0表示不返回HTTP头部信息。
        curl_setopt($ch,CURLOPT_HEADER,0);
        //是否设置http头部消息
        if (!empty($header)) {
            //$header=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        }
        //判断data是否有数据--有是post方式
        if (!empty($data)) {
            curl_setopt($ch,CURLOPT_POST,'TRUE');
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //执行curl请求
        $result = curl_exec($ch);
        //判断是否请求成功
        if (empty($result)) {
            die(curl_error($ch));
        } else {
            $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
            if (empty($code)) {
                die("No HTTP code was returned");
            }
        }
        //关闭请求
        curl_close($ch);
        //返回数据
        return ($code>=200 && $code<300) ? $result : false;
    }

    /**
     * Notes:ajax返回值
     * User: "LiJinGuo"
     * Date: 2018/6/25
     * Time: 17:30
     * @param array  $data
     * @param string $type
     */
    public function ajaxReturn($data = [],$type="json")
    {
        echo json_encode($data);exit;
    }

    /**
     * Notes:
     * User: "LiJinGuo"
     * Date: 2018/7/2
     * Time: 10:47
     * @param array  $arr
     * @param String $string
     */
    public function dump(Array $arr=[],String $string='')
    {
        if(!empty($str)) {
            var_dump($str);
        }
        if(!empty($arr)) {
            echo '<pre>';
            print_r($arr);
            echo '</pre>';
        }
    }

    /**
     * Notes:验证手机号
     * User: "LiJinGuo"
     * Date: 2018/7/2
     * Time: 10:54
     * @param $phone
     * @return bool
     */
    public function regexMobile($phone)
    {
        $pattern = '/^1[34578]\d{9}$/';
        if(preg_match($pattern,$phone)) {
            return true;
        } else {
            return false;
        }
    }
}
