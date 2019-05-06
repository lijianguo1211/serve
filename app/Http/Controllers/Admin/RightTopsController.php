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

    /**
     * RightTopsController constructor.
     * @param RightTopsModel $model
     */
    public function __construct(RightTopsModel $model)
    {
        $this->rightTops = $model;
    }

    public function create()
    {
        return view('admin/right_tops/create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert(Request $request)
    {
        $req = [
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ];

        $data = $this->rightTops->insertRightTops($req);

        if ($data === false) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/right_top/index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->rightTops->getRieghtTops(true);

        return view('admin/right_tops/index')->with(['result' => $result]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $result = $this->rightTops->getRieghtTops(false,$id);

        return view('admin/right_tops/show')->with(['result' => $result]);
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $result = $this->rightTops->getRieghtTops(false,$id);

        return view('admin/right_tops/edit')->with(['result' => $result]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitEdit(Request $request, int $id)
    {
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ];
        $result = $this->rightTops->submitEdit($data,$id);

        if (!$result) {
            return back()->with(['status'=>0,'msg'=>'修改失败']);
        }

        return redirect('admin/right_top/index')->with(['status'=>1,'msg'=>'修改完成']);
    }

    /**
     * @param int $id
     */
    public function del(int $id)
    {
        $result = $this->rightTops->deletes($id);

        if(!empty($result)) {
            $data = ['status'=>1,'msg'=>'删除成功'];
        } else {
            $data = ['status'=>0,'msg'=>'删除失败'];
        }
        $this->ajaxReturn($data);
    }
}
