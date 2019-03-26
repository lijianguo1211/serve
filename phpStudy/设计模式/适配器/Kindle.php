<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:55
 */

class Kindle implements EBookInterface
{
    private $page = 1;

    private $totalPages = 100;

    public function pressNext()
    {
        // TODO: Implement pressNext() method.
        $this->page++;
    }

    public function unlock()
    {
        // TODO: Implement unlock() method.
    }

    public function getPage(): array
    {
        // TODO: Implement getPage() method.
        return [$this->page,$this->totalPages];
    }
}
