<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/15
 * Time: 17:46
 */
namespace App\Http\Controllers\Observer;

class Location
{
    public function index()
    {
        $car = new BigCar('LiYi');
        $locationOne = new LocationOne($car);
        $goOut = new GoOut($locationOne);
        $goOut->display();
    }
}
