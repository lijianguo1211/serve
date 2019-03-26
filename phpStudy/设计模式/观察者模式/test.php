<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 19:06
 */
require_once 'User.php';
require_once 'UserObserver.php';

$observer = new UserObserver();

$user = new User();

$user->attach($observer);

$t = $user->changeEmail('1539853340@qq.com');

var_dump($t);
