<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Test\VehicleInterface;

class IocController
{
    protected $obj;
    public function __construct(VehicleInterface $obj)
    {
        $this->obj = $obj;
    }

    public function goVisit()
    {
        $this->obj->goRun();
    }
}
