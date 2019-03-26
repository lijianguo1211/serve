<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 16:56
 */

require_once 'Ioc.php';
require_once 'Log.php';
require_once 'FileLog.php';
require_once 'DateBaseLog.php';

class UserIoc
{
    private $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        $this->log->write();
    }
}

$ioc = new Ioc();

$ioc->bind('Log','FileLog');
$ioc->bind('user','UserIoc');
$user = $ioc->make('user');

$user->login();
