<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 17:47
 */

class SetCookie implements Milldeware
{
    public static function handle(Closure $closure)
    {
        // TODO: Implement handle() method.
        echo "设置cookie \n";
        $closure();
        echo "cookie设置成功 \n";
    }
}
