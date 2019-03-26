<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:49
 */

class EBookAdapter implements BookInterface
{
    protected $eBook;

    public function __construct(EBookInterface $eBookInterface)
    {
        $this->eBook = $eBookInterface;
    }

    public function open()
    {
        // TODO: Implement open() method.
        $this->eBook->unlock();
    }

    public function turnPage()
    {
        // TODO: Implement turnPage() method.
        $this->eBook->pressNext();
    }

    public function getPage(): int
    {
        // TODO: Implement getPage() method.
        return $this->eBook->getPage()[1];
    }
}
