<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/7
 * Time: 9:11
 */

namespace App\Models\DataModels;


class BookModel extends Model
{
    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [];
}
