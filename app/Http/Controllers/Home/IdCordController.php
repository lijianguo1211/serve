<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\NewIdcard;

class IdCordController extends Controller
{
    use NewIdcard;

    public function test()
    {
        $result = $this->createIdcard($area_code="",$year='',$month='',$day='',$sex='');
        dd($result);
    }
}
