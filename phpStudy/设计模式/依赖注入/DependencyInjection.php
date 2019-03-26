<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:25
 */

require_once 'DbConfigConnection.php';
require_once 'PdoConnection.php';

class DependencyInjection
{
    public function __construct()
    {
        $config = new DbConfigConnection('127.0.0.1',3306,'root','123456','laravel');
        $pdo    = new PdoConnection($config);
        var_dump($pdo->getData());
    }
}
new DependencyInjection();
