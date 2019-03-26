<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:47
 */

class Book implements BookInterface
{
    private $page;


    public function open()
    {
        // TODO: Implement open() method.
        $this->page = 1;
    }

    public function getPage():int
    {
        // TODO: Implement getPage() method.
        return $this->page;
    }

    public function turnPage()
    {
        // TODO: Implement turnPage() method.
        $this->page++;
    }
}
