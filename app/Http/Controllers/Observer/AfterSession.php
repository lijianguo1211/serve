<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/26
 * Time: 18:02
 */
namespace App\Http\Controllers\Observer;

use Mockery\Matcher\Closure;

class AfterSession implements Middleware
{
    public static function handle(Closure $next)
    {
        // TODO: Implement handle() method.
        echo '使用session后关闭session';
        $next();
    }
}
