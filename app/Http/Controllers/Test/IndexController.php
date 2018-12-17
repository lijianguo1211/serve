<?php

namespace App\Http\Controllers\Test;


class IndexController
{
    public function index()
    {
        (new TravelController())->go();
    }
}
