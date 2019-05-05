<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 9:37
 */

namespace Baidu\BaiduLoginSdk\Facades;

use Illuminate\Support\Facades\Facade;

class BaiduLoginSdkFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'baidu';
    }
}
