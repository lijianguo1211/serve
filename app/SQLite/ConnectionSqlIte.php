<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/16
 * Time: 16:02
 */

namespace App\SQLite;


class ConnectionSqlIte extends \SQLite3
{
    private static $instance = null;

    public function __construct()
    {
        try{
            self::$instance = $this->open('test.db');
            echo 'success';
        } catch(\Exception $e){
            return $e;
        }
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            new self();
        }
        return self::$instance;
    }

    public function createTable(String $tableName, array $fieldArray = [],$default = true)
    {
        $fieldArray = [
            '(id'=>'int primary key not null,',
            'name' => 'varchar(15) not null,',
            'email' => 'varchar(20) not null,',
            'create_date' => 'DATETIME not null);'
        ];
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName}";

        foreach ($fieldArray as $k => $v) {
                $sql .= "{$k}"."{$v}";
            }
        $res = (new self())->exec($sql);
        if (!$res) {
            var_dump((new self())->lastErrorMsg());
        }
        echo 'database table create successfully!';
    }
}

//var_dump((new ConnectionSqlIte())->createTable('users'));
for ($i=1; $i <10; $i++) {
    $name = 'liyi_'.mt_rand(10,99);
    $email = mt_rand(10000,9999999).'@qq.com';
    $time = date('Y-m-d H:i:s',strtotime(time(),"+$i day"));
    $sql =<<<EEE
insert into (id, name, email, create_date) values ($i,$name,$email,$time);
EEE;
    $res = (new ConnectionSqlIte())->exec($sql);
    if (!$res) {
        var_dump((new ConnectionSqlIte())->lastErrorMsg());
    }
    echo 'insert date successfully!!!';
}


