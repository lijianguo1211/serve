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
        //$data1 = DB::select("select distinct friend_nickname from mr_keyboardinfo where contact_account_type = wechat order by capture_time desc");
    }
}
