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
    private $obj;

    public function __construct(BlogModel $blog)
    {
        $this->obj = $blog;
    }

    /**
     * 首页展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->obj->getBlog();
        $getRelease = $this->obj->getRelease();
        return view('welcome')->with(['blogs'=>$result,'release'=>$getRelease]);
    }

    public function abc()
    {
        dd(123456);
    }
}
