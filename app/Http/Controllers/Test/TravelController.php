<?php

namespace App\Http\Controllers\Test;


class TravelController
{
    public $obj;
    /*public function __construct()
    {
        $this->obj = new CarController('北京','开汽车');
    }*/

    public function __construct()
    {
        $this->obj = (new FactoryController('CarController','南京','开汽车'))->choice();
    }

    public function go()
    {
        $this->obj->goToTarget();
    }
}
