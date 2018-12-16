<?php

namespace App\Http\Controllers\Home;

use App\Traits\Fourteen;

class FifteenController
{
    use Fourteen;

    protected $name = '小李子';

    public function setValue()
    {
        // TODO: Implement setValue() method.
       return $this->name;
    }
}
