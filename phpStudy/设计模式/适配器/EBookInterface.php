<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:51
 */
interface EBookInterface
{
    public function unlock();

    public function pressNext();

    public function getPage(): array;
}
