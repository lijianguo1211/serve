<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-05-16
 * Time: 23:06
 */

class Mysql
{
    private static $instance = null;

    private function __construct()
    {
        self::$instance = new PDO("mysql:host=;port=;dbname=",'','');
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}