<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/15
 * Time: 17:43
 */
namespace App\Http\Controllers\Observer;

class GoOut extends Liyi
{
    public function disPlay()
    {
        echo "出门前\n";
        parent::disPlay(); // TODO: Change the autogenerated stub
        echo "出门后\n";
    }
}