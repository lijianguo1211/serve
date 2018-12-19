<?php

namespace App\Http\Controllers\Test;
use Illuminate\Support\Facades\DB;

class IndexController
{
    public function index()
    {
        (new TravelController())->go();
    }

    public function testSql()
    {
        $traf = new LegController();
        //依赖注入方式解决问题
        $tra = new IocController($traf);
        $tra->goVisit();
    }
}
