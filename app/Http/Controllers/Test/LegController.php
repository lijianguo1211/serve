<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Test\VehicleInterface;

class LegController implements VehicleInterface
{
    public function goRun()
    {
        // TODO: Implement goRun() method.
        echo $this->goToTarget();
    }

    public function goToTarget()
    {
        // TODO: Implement goToTarget() method.
        return '我要去旅游了，锻炼自己';
    }
}
