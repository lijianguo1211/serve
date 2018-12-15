<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/15
 * Time: 17:24
 */
namespace App\Traits;

trait Priority
{
    public function index()
    {
        echo '这是Priority trait 里的index() 方法';
    }

    public function edit()
    {
        parent::edit();
        echo '这是Priority trait 里的edit() 方法';
    }
}