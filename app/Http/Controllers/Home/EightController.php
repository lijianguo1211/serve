<?php

namespace App\Http\Controllers\Home;

use App\Traits\Seven;

class EightController
{
    use Seven{
        sayHello as protected;
    }

    public function sayWorld()
    {
        $this->sayHello();
    }
}
