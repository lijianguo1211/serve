<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 18:01
 */
namespace App\Traits;

trait Four
{
    public function save()
    {
        echo '这是Fore里的save()方法';
    }

    public function store()
    {
        echo '这是Fore里的store()方法';
    }
}