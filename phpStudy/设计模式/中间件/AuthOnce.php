<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 17:41
 */

class AuthOnce implements Milldeware
{
    public static function handle(Closure $closure)
    {
        // TODO: Implement handle() method.
        echo "验证第一次登陆\n";
        $closure();
    }
}
