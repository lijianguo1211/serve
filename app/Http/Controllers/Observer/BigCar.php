<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/15
 * Time: 16:45
 */
namespace App\Http\Controllers\Observer;

class BigCar implements Car
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function disPlay()
    {
        // TODO: Implement disPlay() method.
        echo '我是：' . $this->name . "==，我出门了！！！\n";
    }
}

