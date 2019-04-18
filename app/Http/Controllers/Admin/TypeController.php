<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DataModels\TypeModel;

class TypeController extends BaseController
{
    private $obj;

    /**
     * 注入模型
     * TypeController constructor.
     * @param TypeModel $type
     */
    public function __construct(TypeModel $type)
    {
        $this->obj = $type;
    }

    /**
     * 添加文章分类表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $types = $this->obj->getType();

        return view('admin/type/create',compact('types'));
    }

    /**
     * 添加文章分类提交保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $name = $request->get('title');
        $pid  = $request->get('pid');
        if(empty(trim($name)) || !isset($pid)) {
            return back()->with(['status'=>0,'msg'=>'参数不全']);
        }
        $data = [
            'name'         =>$name,
            'pid'          =>$pid,
        ];
        $type = $this->obj::create($data);
        if(!$type) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/right_top/indexs');


    }

    /**
     * 查看分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $types = $this->obj->getType();

        if($types == null) {
            return back()->with(['status'=>0,'msg'=>'没有数据或查询失败']);
        }
        return view('admin/type/index',['list'=>$types]);
    }

    /**
     * 编辑分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $type_list = $this->obj->getFirstType($id);

        if($type_list == null) return back()->with(['status'=>0,'msg'=>'没有查询结果']);
        return view('admin/type/edit',compact('type_list'));
    }

    /**
     * 编辑分类提交
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $info = $request->all();
        $name = $info['name'];
        $pid = $info['pid'];

        $data = [
            'name' => $name,
            'pid'=> $pid,
        ];

        $type = $this->obj->updateType($data,$id);
        //更新语句
        if(!$type) {
            return back()->with(['status'=>0,'msg'=>'修改失败']);
        }
        return redirect('admin/type')->with(['status'=>1,'msg'=>'修改完成']);
    }

    /**
     * 查看具体某一个分类
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id)
    {
        if(empty($id)) return back()->with(['status'=>0,'msg'=>'参数不对']);
        $type_list = $this->obj->getFirstType($id);

        if($type_list == null) return back()->with(['status'=>0,'msg'=>'没有查询结果']);
        return view('admin/type/show',compact('type_list'));
    }

    /**
     * 删除分类
     * @param $id
     */
    public function del($id)
    {
        $data = $this->obj->deteleType($id);
        if(!empty($data)) {
            $data = ['status'=>1,'msg'=>'删除分类成功'];
        } else {
            $data = ['status'=>0,'msg'=>'删除分类失败'];
        }
        $this->ajaxReturn($data);
    }
}
