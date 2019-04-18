<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 20:08
 */

namespace App\Http\Controllers\Admin;


class HeaderController extends BaseController
{
    public function create()
    {
        return view('admin/header/create')->with(['result'=>config('config')]);
    }
}
