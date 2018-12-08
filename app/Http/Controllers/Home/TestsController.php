<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestsController extends Controller
{
    public function test()
    {
        dd(explode(':','微信ID:wxid_2hfqa35obfwi22,昵称:愛笑得眼睛,微信号:sts124,个人签名:,地区:'));
    }
}
