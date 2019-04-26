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
        $user = $this->socialite->driver('github')->user();
        \Log::info(json_encode($user));
        $data = [

        ];
    }
}
