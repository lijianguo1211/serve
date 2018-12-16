<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/16
 * Time: 16:26
 */
namespace App\Traits;

trait Fourteen
{
    public function getValue()
    {
        echo '**'."<br />";
        echo '这个trait  Fourteen里面的抽象方法setValue():'.$this->setValue();
    }

    abstract public function setValue();
}