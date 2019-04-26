<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/26
 * Time: 9:55
 */

namespace App\Http\Controllers\Auth;

use Overtrue\Socialite\SocialiteManager;
use App\Http\Controllers\Controller;

class GithubController extends Controller
{
    private $socialite;

    public function __construct(SocialiteManager $socialite)
    {
        $this->socialite = $socialite;
    }

    public function redirectToProvider()
    {
        return $this->socialite->driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $github = $this->socialite->driver('github')->user();

        $data = [
            'username' => $github->getUsername(),
            'email'    => $github->getEmail(),
            'phone'    => $this->getPhone(),
            'validate_token' => str_random(24),
            'is_validate' => 1,
            'provider' => 'github',
            'avatar' => $github->getAvatar(),
        ];
    }

    public function getPhone()
    {
        $str = '3456789';
        $strlen = strlen($str);
        $two = mt_rand(0,$strlen-1);
        $oneStr = 1;
        $str = str_shuffle($str);
        $twoStr = $str[$two];
        $strs = '0123456789';
        $strsLen = strlen($strs);

        $code = '';
        for($i=0;$i<9;$i++) {

            $e = mt_rand(0,$strsLen-1);
            $strs = str_shuffle($strs);
            $code .= $strs[$e];
        }

        $phone = $oneStr.$twoStr.$code;

        return $phone;
    }
}
