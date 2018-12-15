<?php

namespace App\Http\Controllers\Home;

use App\Traits\Three;
use App\Traits\Four;

class FivesController
{
    use Three,Four{
        Three::save insteadof Four;
        Four::store insteadof Three;
    }
}
