<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 15:41
 */

class UserDataBase
{
    private $log;

    public function __construct()
    {
        $this->log = new DateBaseLog();
    }

    public function login()
    {
        /**
         * 登录成功后写日志，目前是用文件的方式写日志
         */
        $this->log->write();
    }
}
