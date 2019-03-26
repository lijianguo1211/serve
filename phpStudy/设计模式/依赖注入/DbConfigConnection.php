<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:11
 */
class DbConfigConnection
{
    private $host;

    private $port;

    private $username;

    private $password;

    private $dbName;

    public function __construct(string $host,int $port,string $username,string $password,string $dbName)
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->username = $username;
        $this->password = $password;
        $this->dbName   = $dbName;
    }

    public function getHost():string
    {
        return $this->host;
    }

    public function getPort():int
    {
        return $this->port;
    }

    public function getUsername():string
    {
        return $this->username;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function getDbName():string
    {
        return $this->dbName;
    }
}
