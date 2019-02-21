<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/18
 * Time: 10:24
 */
namespace App\Http\Controllers\Observer;

use Mockery\Matcher\Closure;

class Jwt implements Middleware
{
    public static function handle(Closure $next)
    {
        // TODO: Implement handle() method.
    }
}
