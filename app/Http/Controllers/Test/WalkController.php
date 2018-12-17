<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Test\VehicleInterface;

class WalkController implements VehicleInterface
{
    protected $_run;
    protected $_target;

    public function __construct($run,$target)
    {
        $this->_run = $run;
        $this->_target = $target;
    }

    public function goRun()
    {
        // TODO: Implement goRun() method.
        return $this->_run;

    }

    public function goToTarget()
    {
        // TODO: Implement goToTarget() method.
        echo '我要去'.$this->goRun().'了，锻炼自己，我将要'.$this->_target.'过去';
    }
}
