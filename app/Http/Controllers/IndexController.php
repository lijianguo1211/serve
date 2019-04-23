<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:06
 */

namespace App\Http\Controllers;


use App\Models\DataModels\BlogModel;
use App\Models\DataModels\CommentModel;
use App\Models\DataModels\HeaderModel;
use App\Models\DataModels\ImageModel;
use App\Models\DataModels\RightTopsModel;
use Illuminate\Http\Request;

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
        $headerResult = (new ImageModel())->getHeaderIndex();
        return view('home')->with([
            'blogs'=>$result,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue,
            'result' => $headerResult
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
        $headerResult = (new ImageModel())->getHeaderIndex();
        $comments = (new CommentModel())->getComments($id);
        return view('details')->with([
            'details'=>$data,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue,
            'result' => $headerResult,
            'comments' => $comments
        ]);
    }

    public function ajaxComment(Request $request, $id)
    {
        $info = $request->all();
        $data = [
            'content'   => $info['content'],
            'layer_user_id' => $info['l_user_id']
        ];
        $result = (new CommentModel())->addCommments($data, $id);

        if ($result['status'] != MYSQL_INSERT_IS_SUCCESS) {
            return json_encode($result);
        }

        return json_encode($result);
    }

}
