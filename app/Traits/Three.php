<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/13
 * Time: 16:03
 */
namespace App\Traits;

trait Three
{
    public function save()
    {
        echo '这是Three里的save()方法';
    }

    public function store()
    {
        echo '这是Three里的store()方法';
    }
}