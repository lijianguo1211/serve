<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 20:04
 */

namespace App\Http\Controllers\Admin;

use App\Models\DataModels\RightTopsModel;
use Illuminate\Http\Request;

class RightTopsController extends BaseController
{
    private $rightTops;

    public function __construct(RightTopsModel $model)
    {
        $this->rightTops = $model;
    }

    public function create()
    {
        return view('admin/right_tops/create');
    }

    public function insert(Request $request)
    {
        $req = ['content' => $request->get('content')];
        $data = $this->rightTops->insertRightTops($req);

        if (!empty($data)) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('right_top/indexs');
    }

    public function index()
    {
        $result = $this->rightTops->getRieghtTops(true);
        return view('right_top/indexs')->with(['result' => $result]);
    }
}
