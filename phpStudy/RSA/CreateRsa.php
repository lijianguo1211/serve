<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/23
 * Time: 18:03
 */

class CreateRsa
{
    public $rsa = [];

    public function __construct()
    {
        $this->setRsa();
    }

    public function getRsa()
    {
        return $this->rsa;
    }

    public function setRsa()
    {
        for ($i=1; $i< 100000000; $i++) {

        }
    }
}
