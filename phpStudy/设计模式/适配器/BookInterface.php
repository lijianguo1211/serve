<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:45
 */
interface BookInterface
{
    public function open();

    public function getPage();

    public function turnPage();
}
