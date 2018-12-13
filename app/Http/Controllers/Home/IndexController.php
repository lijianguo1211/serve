<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\One;
use App\Traits\Two;
//define ('M_PI', 3.1415926535898);
class IndexController extends Controller
{

    use One,Two;
    public function index()
    {
        return view('home/index/index');
    }

    public function test()
    {
        $this->indexTestOne();
        $this->indexTestTwo();
        echo "这是普通类 IndexController 的test方法 <br />";
        $point_lat = '30.447065';
        $target_lat = '30.449494202931';
        $point_lon = '114.479429';
        $target_lon = '114.47977978815';
        $distance = 6370996.81 * acos(cos($point_lat * M_PI / 180) * cos($target_lat * M_PI / 180) * cos($point_lon * M_PI / 180 - $target_lon * M_PI / 180) + sin($point_lat * M_PI / 180) * sin($target_lat * M_PI / 180));
        return round($distance);
    }
}
