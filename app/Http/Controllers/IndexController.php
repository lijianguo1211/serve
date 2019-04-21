<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Models\DataModels\BlogModel;
use App\Models\DataModels\HeaderModel;
use App\Models\DataModels\RightTopsModel;

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
        $getValue = $this->obj->getValue();
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        $header = (new HeaderModel())->getIndexHeader();
        $right = (new HeaderModel())->getIndexHeader(1);
        return view('home')->with([
            'blogs'=>$result,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue
        ]);
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
        $getValue = $this->obj->getValue();
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        $header = (new HeaderModel())->getIndexHeader();
        $right = (new HeaderModel())->getIndexHeader(1);
        return view('details')->with([
            'details'=>$data,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue
        ]);
    }

    public function test()
    {
        return view('test');
    }

}
