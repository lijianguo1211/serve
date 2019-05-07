<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 20:08
 */

namespace App\Http\Controllers\Admin;

use App\Models\DataModels\HeaderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeaderController extends BaseController
{
    /**
     * @var HeaderModel
     */
    private $headrs;

    /**
     * HeaderController constructor.
     * @param HeaderModel $model
     */
    public function __construct(HeaderModel $model)
    {
        $this->headrs = $model;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin/header/create')->with(['result'=>array_reverse(config('config.header'))]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function insert(Request $request)
    {
        $info = $request->all();
        $validator = Validator::make($info, [
            'title' => 'required|max:10',
            'url' => 'required|max:20',
            'priority' => 'required|integer|between:0,99',
            'type' => 'required|integer|between:0,1',
        ]);

        if ($validator->fails()) {
            return back()->with(['status'=>0,'msg'=>$validator->errors()->all()[0]]);
        }

        $data = [
            'title'    => $info['title'],
            'url'      => $info['url'],
            'priority' => $info['priority'],
            'type'     => $info['type']
        ];

        $result = $this->headrs->add($data);

        if(!$result) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/header/index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->headrs->getHeaders(true);

        return view('admin/header/index')->with(['result'=>$result]);
    }

    public function show(int $id)
    {
        $result = $this->headrs->getHeaders(false,$id);

        return view('admin/header/show')->with(['result'=>$result]);
    }

    public function edit(int $id)
    {
        $result = $this->headrs->getHeaders(false,$id);

        return view('admin/header/edit')->with(['result'=>$result,'config'=>config('config')]);
    }

    public function submitEdit(Request $request, int $id)
    {
        $info = $request->all();
        $data = [
            'title'    => $info['title'],
            'url'      => $info['url'],
            'priority' => $info['priority'],
            'type'     => $info['type']
        ];
        $result = $this->headrs->submitEdit($id,$data);

        if (!$result) {
            return back()->with(['status'=>0,'msg'=>'修改失败']);
        }

        return redirect('admin/header/index')->with(['status'=>1,'msg'=>'修改完成']);
    }

    public function del(int $id)
    {
        $result = $this->headrs->deletes($id);

        if(!empty($result)) {
            $data = ['status'=>1,'msg'=>'删除成功'];
        } else {
            $data = ['status'=>0,'msg'=>'删除失败'];
        }
        $this->ajaxReturn($data);
    }
}
