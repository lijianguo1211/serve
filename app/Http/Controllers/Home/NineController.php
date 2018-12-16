<?php

namespace App\Http\Controllers\Home;

use App\Traits\Seven;

class NineController
{
    use Seven{
        sayHello as public;
    }

    public function sayWorld()
    {
        $this->sayHello();
    }
}