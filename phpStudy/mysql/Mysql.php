<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/23
 * Time: 15:27
 */

class Mysql
{
    private static $host = '127.0.0.1';
    private static $port = 3306;
    private static $userName = 'root';
    private static $password = '123456';
    private static $dataBase = 'laravel';

    private static $instance;

    private function __construct()
    {
        try {
            $dsn = "mysql:host=".self::$host.";dbname=".self::$dataBase.";charset=UTF8;port=".self::$port;
            self::$instance = new \PDO($dsn,self::$userName,self::$password);
        } catch (\PDOException $e) {
            $msg = $e->getMessage();
            $line = $e->getLine();
            $code = $e->getCode();
            $file = $e->getFile();
            $error =  '文件：'.$file."\n".'有错误，在第 '.$line."行。\n错误消息：".$msg."\n错误code：".$code;
            exit($error);
        }
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            return self::$instance = new self();
        }
        return self::$instance;
    }
}
