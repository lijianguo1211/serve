<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/18
 * Time: 10:22
 */

namespace App\Http\Controllers\Observer;

use Mockery\Matcher\Closure;

interface Middleware
{
    public static function handle(Closure $next);
}
