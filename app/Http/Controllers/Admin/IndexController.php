<?php
/**
 * Created by PhpStorm.
 * User: "lijianguo"
 * Date: 2018/5/24
 * Time: 20:07
 */

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CardIdController;
use Ofcold\IdentityCard\IdentityCard;
class IndexController extends BaseController
{
    public function index(Request $request)
    {
        return view('admin/index/index');//需要定义路由,在浏览器输入admin/index 访问
    }
}


