<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/28
 * Time: 16:02
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GitHubController extends BaseController
{
    const CLIENT_ID = '8926fa7400f0b75dbe59';

    const CLIENT_SECRET = '0380682246c41063615918092b75923266122c9f';

    const REDIRECT_URL = 'http://localhost:8009/admin/liyi/github/callback';

    /**
     * 点击请求url跳转到授权页面
     */
    public function loginToGithub()
    {
        //GET https://github.com/login/oauth/authorize
        $url = 'https://github.com/login/oauth/authorize?client_id='.static::CLIENT_ID.'&scope=user:email&redirect_uri='.static::REDIRECT_URL;

        return $this->getCurlHttps($url);
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
        $code = $request->get('code');
        if (empty($code)) {
            return redirect('admin/');
        }

        if (!is_string($code)) {
            return redirect('admin/');
        }

        $tokenUrl = 'https://github.com/login/oauth/access_token';

        $data = [
            'client_id' => static::CLIENT_ID,
            'client_secret' => static::CLIENT_SECRET,
            'code' => $code,
            'redirect_uri' => static::REDIRECT_URL
        ];

        $data = json_encode($data);
        $result = $this->setCurlHttp($tokenUrl,$data);

        if(empty($result)) {
            return redirect('admin/');
        }

        /**
         * {
         *   "access_token":"605f1690176301f4a37982163642040d089988d1",
         *   "token_type":"bearer",
         *   "scope":"user:email"
         *  }
         */

        $access_token = json_decode($result,true)['access_token'];

        //https://api.github.com/user?access_token=eddfd2932c452beb0af26a355b29bf3007cf71ce
        $apiUrl = 'https://api.github.com/user?access_token='.$access_token;

        /**
         * {
         *   "login": "lijianguo1211",
         *   "id": 38551872,
         *   "node_id": "MDQ6VXNlcjM4NTUxODcy",
         *   "avatar_url": "https://avatars3.githubusercontent.com/u/38551872?v=4",
         *   "gravatar_id": "",
         *   "url": "https://api.github.com/users/lijianguo1211",
         *   "html_url": "https://github.com/lijianguo1211",
         *   "followers_url": "https://api.github.com/users/lijianguo1211/followers",
         *   "following_url": "https://api.github.com/users/lijianguo1211/following{/other_user}",
         *   "gists_url": "https://api.github.com/users/lijianguo1211/gists{/gist_id}",
         *   "starred_url": "https://api.github.com/users/lijianguo1211/starred{/owner}{/repo}",
         *   "subscriptions_url": "https://api.github.com/users/lijianguo1211/subscriptions",
         *   "organizations_url": "https://api.github.com/users/lijianguo1211/orgs",
         *   "repos_url": "https://api.github.com/users/lijianguo1211/repos",
         *   "events_url": "https://api.github.com/users/lijianguo1211/events{/privacy}",
         *   "received_events_url": "https://api.github.com/users/lijianguo1211/received_events",
         *   "type": "User",
         *   "site_admin": false,
         *   "name": null,
         *   "company": null,
         *   "blog": "",
         *   "location": null,
         *   "email": null,
         *   "hireable": null,
         *   "bio": null,
         *   "public_repos": 5,
         *   "public_gists": 0,
         *   "followers": 0,
         *   "following": 0,
         *   "created_at": "2018-04-20T06:31:51Z",
         *   "updated_at": "2019-04-16T11:25:06Z"
         * }
         */
        $result = $this->setCurlHttp($apiUrl,'');

        dd($result);
    }

    private function exec_curl($url, $method = 'get', $data = null, $header = [])
    {
        $curl = curl_init();
        if ($method == 'post') {
            curl_setopt($curl, CURLOPT_POST, 1);
            if (!empty($data)) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
        }
        $headers=array( "Accept: application/json", "Content-Type: application/json;charset=utf-8" );
        if (!empty($header)) {
            $headers = array_merge($headers,$header);
        }
        curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, 200);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

        $res = curl_exec($curl);

        curl_close($curl);
        return !is_null(json_decode($res, true)) ? json_decode($res, true) : $res;
    }
}
