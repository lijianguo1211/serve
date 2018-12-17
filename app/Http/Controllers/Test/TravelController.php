<?php

namespace App\Http\Controllers\Test;


class TravelController
{
    public $obj;
    public function __construct()
    {
        $this->obj = new CarController('北京','开汽车');
    }

    public function go()
    {
        $this->obj->goToTarget();
    }
}
