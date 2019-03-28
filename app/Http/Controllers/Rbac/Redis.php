<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/28
 * Time: 16:10
 */

namespace App\Http\Controllers\Rbac;


class Redis
{
    public function index()
    {
        new \Illuminate\Support\Facades\Redis();
    }
}
