<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/26
 * Time: 17:59
 */
namespace App\Http\Controllers\Observer;

use Mockery\Matcher\Closure;

class Session implements Middleware
{
    public static function handle(Closure $next)
    {
        // TODO: Implement handle() method.
        echo '使用session前检测session值';
        $next();
        echo '使用后共享session值';
    }
}
