<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:11
 */
class PdoConnection
{
    private $configGuration;

    public function __construct(DbConfigConnection $dbConfigConnection)
    {
        $this->configGuration = $dbConfigConnection;
    }

    public function getData() :array
    {
        return [
                $this->configGuration->getUsername(),
                $this->configGuration->getPassword(),
                $this->configGuration->getHost(),
                $this->configGuration->getPort(),
                $this->configGuration->getDbName()
        ];
    }
}
