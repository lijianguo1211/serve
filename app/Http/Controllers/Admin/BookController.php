<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/7
 * Time: 9:10
 */

namespace App\Http\Controllers\Admin;


use App\Models\DataModels\BookModel;

class BookController
{
    private $book;

    public function __construct(BookModel $book)
    {
        $this->book = $book;
    }
}
