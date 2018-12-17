<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Test\WalkController;
use App\Http\Controllers\Test\CarController;
use App\Http\Controllers\Test\TrainController;
use App\Http\Controllers\Test\AircraftController;

class FactoryController
{
    protected $_type;
    protected $_run;
    protected $_target;

    public function __construct($type,$run,$target)
    {
        $this->_type = $type;
        $this->_run = $run;
        $this->_target = $target;
    }

    public function choice()
    {
        switch ($this->_type)
        {
            case 'WalkController':
                $example = new WalkController($this->_run,$this->_target);
                break;
            case 'CarController':
                $example = new CarController($this->_run,$this->_target);
                break;
            case 'TrainController':
                $example = new TrainController($this->_run,$this->_target);
                break;
            case 'AircraftController':
                $example = new AircraftController($this->_run,$this->_target);
                break;
            default:
                $example = false;
                break;
        }
        return $example;
    }
}
