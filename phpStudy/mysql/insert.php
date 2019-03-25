<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/23
 * Time: 15:45
 */

class Mysql extends PDO
{
    private static $host = 'localhost';
    private static $port = 3306;
    private static $userName = 'root';
    private static $password = '123456';
    private static $dataBase = 'laravel';

    private static $instance = null;

    public function __construct()
    {
        $dsn = "mysql:host=".self::$host.";dbname=".self::$dataBase.";port=".self::$port;

        try {
            self::$instance =  parent::__construct($dsn,self::$userName,self::$password);
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

$pdo = Mysql::getInstance();
//var_export(get_loaded_extensions());

function getPassword()
{
    $str = 'qwertyuiopasdfghjklzxcvbnmZXCVBNMLKJHGFDSAQWERTYUIOP1234567890';
    $strlen = strlen($str);
    $pass = '';
    for ($i=0; $i<6; $i++) {
        $line = mt_rand(0,$strlen-1);
        $pass .= $str[$line];
    }
    return $pass;
}

function getEmail()
{
    $str = 'qwertyuiopasdfghjklzxcvbnmZXCVBNMLKJHGFDSAQWERTYUIOP1234567890';
    $strlen = strlen($str);
    $email = '';
    for ($i=0; $i<9; $i++) {
        $line = mt_rand(0,$strlen-1);
        $email .= $str[$line];
    }
    $email .= '@';

    $arr = [
        'qq.com',
        'hotmial.com',
        '163.com',
        'gmail.com',
        'yahoo.com',
        '126.com',
        '188.com',
        'yahoo.com.cn',
        'sina.com',
        'sohu.com',
        'tom.com'
    ];
    $count = count($arr);
    $li = mt_rand(0,$count-1);
    $email .= $arr[$li];
    return $email;
}

/*
for ($i=0; $i<5000; $i++) {
    $name = getPassword();
    $password = md5(getPassword());
    $email = getEmail();
    $create_at = time();
    $update_at = time();
    $nick_name = getPassword().'__'.$i;
    $sql = "insert into users_bak (`name`,password,email,create_at,update_at,nick_name) values (?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1,$name);
    $stmt->bindValue(2,$password);
    $stmt->bindValue(3,$email);
    $stmt->bindValue(4,$create_at);
    $stmt->bindValue(5,$update_at);
    $stmt->bindValue(6,$nick_name);
    $stmt->execute();
    $insert_id = $pdo->lastInsertId();
    echo $insert_id."\n";
}*/

for ($i=0; $i<5000; $i++) {
    $name = getPassword();
    $password = md5(getPassword());
    $email = getEmail();
    $create_at = time();
    $update_at = time();
    $sql = "insert into users (`name`,password,email,create_at,update_at,age) values (?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1,$name);
    $stmt->bindValue(2,$password);
    $stmt->bindValue(3,$email);
    $stmt->bindValue(4,$create_at);
    $stmt->bindValue(5,$update_at);
    $stmt->bindValue(6,mt_rand(1,120));
    $stmt->execute();
    $insert_id = $pdo->lastInsertId();
    echo $insert_id."\n";
}
