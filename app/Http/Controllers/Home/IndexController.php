<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('home/index/index');
    }

    public function test()
    {
        echo '{' . '微信ID:wxid_2hfqa35obfwi22,昵称:愛笑得眼睛,微信号:sts124,个人签名:,地区:' . '}';
        $arr = explode(',','微信ID:wxid_2hfqa35obfwi22,昵称:愛笑得眼睛,微信号:sts124,个人签名:,地区:');
        dd(json_encode($arr));
        print_r($arr);
        foreach ($arr as $k => $v) {
            $arr[$k] = explode(':',$v);
        }
        dd($arr);
    }
}
