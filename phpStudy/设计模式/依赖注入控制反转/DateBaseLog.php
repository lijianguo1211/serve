<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 15:31
 */

class DateBaseLog implements Log
{
    public function write()
    {
        // TODO: Implement write() method.
        echo 'create database log is success!!!';
    }
}
