<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/26
 * Time: 17:43
 */
namespace App\Http\Controllers\Observer;

use Mockery\Matcher\Closure;

class BeforeSession implements Middleware
{
    public static function handle(Closure $next)
    {
        // TODO: Implement handle() method.
        echo '使用session前开启session';
        $next();
    }
}
