<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 17:42
 */

class AuthTwo implements Milldeware
{
    public static function handle(Closure $closure)
    {
        // TODO: Implement handle() method.
        $closure();
        echo "检测第二次登陆\n";

    }
}
