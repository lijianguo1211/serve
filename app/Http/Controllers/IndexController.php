<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Models\DataModels\BlogModel;
use Illuminate\Support\Facades\DB;

class IndexController
{
    /**
     * 首页展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $blog = new BlogModel();
        $result = $blog->blogContent()->where('delete_status','=',1)->get()->toArray();
        dd($result);
        return view('welcome')->with(['blogs'=>$result]);
    }
}
