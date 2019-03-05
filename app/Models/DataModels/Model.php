<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/4
 * Time: 19:55
 */

namespace App\Models\DataModels;
use Watson\Rememberable\Rememberable;
use \Illuminate\Database\Eloquent\Model as Eloquent;


abstract class Model extends Eloquent
{
    use Rememberable;
}
