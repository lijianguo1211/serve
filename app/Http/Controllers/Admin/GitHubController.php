<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/28
 * Time: 16:02
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class GitHubController extends BaseController
{
    const CLIENT_ID = '8926fa7400f0b75dbe59';

    const CLIENT_SECRET = '0380682246c41063615918092b75923266122c9f';

    const REDIRECT_URL = 'http://localhost:8009/liyi/github/callback';

    /**
     * 点击请求url跳转到授权页面
     */
    public function loginToGithub()
    {
        //GET https://github.com/login/oauth/authorize
        $url = 'https://github.com/login/oauth/authorize?client_id'.static::CLIENT_ID.'&scope=user:email&redirect_uri='.static::REDIRECT_URL;

        return "<a href=\"{$url}\">跳转</a>";
        //POST https://github.com/login/oauth/access_token
        /**
         * client_id 8926fa7400f0b75dbe59
         * client_secret 0380682246c41063615918092b75923266122c9f
         * code 第一步get请求得到的code
         * redirect_uri http://localhost:8009/liyi/github/callback
         */

        //https://api.github.com/user?access_token=access_token
    }

    public function handleGithub(Request $request)
    {
        dd($request->all());
    }
}
