<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 17:46
 */

class VerfiyCsrfToekn implements Milldeware
{
    public static function handle(Closure $closure)
    {
        // TODO: Implement handle() method.
        echo "登陆前验证 token \n";
        $closure();
    }
}
