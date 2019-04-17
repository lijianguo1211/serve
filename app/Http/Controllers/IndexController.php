<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Models\DataModels\BlogModel;
use App\Models\DataModels\RightTopsModel;
use Illuminate\Http\Request;
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
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        return view('home')->with(['blogs'=>$result,'release'=>$getRelease,'reghtTops'=>$reghtTops]);
    }

    /**
     * 详情页面
     */
    public function details($id)
    {
        if (!is_int($id)) {
            $id = (int)$id;
        }
        $data = $this->obj->getDetails($id);
        $getRelease = $this->obj->getRelease();
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        return view('details')->with(['details'=>$data,'release'=>$getRelease,'reghtTops'=>$reghtTops]);
    }

    public function test()
    {
        return view('test');
    }

}
