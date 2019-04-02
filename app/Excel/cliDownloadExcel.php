<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/29
 * Time: 15:04
 */

require_once 'XLSXWriter.php';


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

class cliDownloadExcel
{
    public $pdo;
    private $xlsx;
    private $sql;

    public function __construct(\XLSXWriter $xlsx)
    {
        $this->pdo = Mysql::getInstance();
        $this->xlsx = $xlsx;
    }

    public function mysql()
    {

    }

    public function field($field = '*')
    {
        $this->sql = "select ". $field . " from ";
        return $this;
    }

    public function table($table)
    {
        $this->sql .= $table . " ";
        return $this;
    }

    public function orderBy($order,$sort='DESC')
    {
        $this->sql .= "order by ".$order ." ".$sort." ";
        return $this;
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        switch ($boolean) {
            case 'and':
                $this->sql .= "where ".$column . $operator . " ".$value . " ";
                break;
            case 'or':
                $this->sql .= "or ".$column . $operator . " ".$value . " ";
                break;
            default:
                var_dump('is error');
                break;
        }
        return $this;

    }

    public function count($count="count(*)")
    {
       $this->sql = "select ".$count ." ";
       return $this;
    }

    public function offset($offset = 1)
    {
        $this->sql .= "offset ".$offset . " ";
    }

    public function limit($limit = 100)
    {
        $this->sql .= "limit ".$limit;
    }

    public function getDownload()
    {
        $data = $this->count()->table('users')->where('name','=','root')->orderBy('id');
        return $data;
    }

    public function countSql($column, $start=1, $count=100)
    {
        $countSql = "select count(*) from users_bak order by ? desc limit ?,?";
        $stmt = $this->pdo->prepare($countSql);
        $start = ($start-1)*$count;
        $stmt->bindValue(1,$column,PDO::PARAM_STR);
        $stmt->bindValue(2,$start,PDO::PARAM_INT);
        $stmt->bindValue(3,$count,PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchAll();
        return $count;
    }

    public function dataSql($column='id', $start=1, $count=10)
    {
        $sql = "select * from users_bak order by ? desc limit ?,?";

        $stmt = $this->pdo->prepare($sql);
        $start = ($start-1)*$count;
        $stmt->bindValue(1,$column,PDO::PARAM_STR);
        $stmt->bindValue(2,$start,PDO::PARAM_INT);
        $stmt->bindValue(3,$count,PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }

    public function chunks($column, $count=100)
    {
        $start = 1;
        do {

        } while(true);
        while(true){



        }
    }
}

$writer = new \XLSXWriter();
$pdo = Mysql::getInstance();
var_dump((new cliDownloadExcel($writer,$pdo))->countSql('id')[0][0]);
