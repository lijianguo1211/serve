<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/26
 * Time: 14:58
 */
require_once 'BookInterface.php';
require_once 'Book.php';
require_once 'EBookInterface.php';
require_once 'EBookAdapter.php';
require_once 'Kindle.php';



class Adapter
{
    public function testCanTurnPageOnBook()
    {
        $book = new Book();
        $book->open();
        $book->turnPage();
        var_dump($book->getPage());
    }

    public function testCanTurnPageOnKindleLikeInANormalBook()
    {
        $kindle = new Kindle();
        $book   = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();
        var_dump($book->getPage());
    }
}

$t = new Adapter();

$t->testCanTurnPageOnBook();

$t->testCanTurnPageOnKindleLikeInANormalBook();
