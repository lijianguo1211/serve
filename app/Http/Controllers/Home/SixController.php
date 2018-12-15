<?php

namespace App\Http\Controllers\Home;

use App\Traits\Three;
use App\Traits\Four;

class SixController
{
    use Three,Four{
        Three::save insteadof Four;//Three::save里的方法代替Four里的save方法输出
        Four::save as save1;//Four里的方法起别名输出
        Four::store insteadof Three;
        Three::store as store1;
    }
}
