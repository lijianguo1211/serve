<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 9:53
 */

namespace Baidu\BaiduLoginSdk;

use Illuminate\Support\ServiceProvider;

class BaiduLoginSdkServiceProvider extends ServiceProvider
{
    protected $defer = false; // 延迟加载服务

    public function boot()
    {
        $this->publishes([
            __DIR__.'../config/config.php' => config_path('baidu.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('Baidu',function(){
            return new Baidu(config('socialite.baidu.apiKey'),config('socialite.baidu.secretKey'),config('socialite.baidu.redirect_uri'));
        });
    }
}
