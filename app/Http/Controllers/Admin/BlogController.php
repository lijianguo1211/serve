<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 20:00
 */

namespace App\Http\Controllers\Admin;


use App\Models\DataModels\BlogModel;
use App\Models\DataModels\TypeModel;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    private $blog;

    public function __construct(BlogModel $model)
    {
        $this->blog = $model;
    }

    public function create()
    {
        $data = (new TypeModel())->getType();
        return view('admin/blog/create')->with(['data'=>$data]);
    }

    public function insert(Request $request)
    {
        $info = $request->all();

        $data = [
            'title' => $info['title'],
            'info'  => $info['info'],
            'label' => $info['label'],
        ];
        $content = [
            'content' => $info['post']['post_content'],
            'content_md' => $info['test-editormd-html-code']
        ];

        $result = $this->blog->insertBlog($data,$content);

        if (!$result) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/blog/index');
    }

    public function index()
    {
        $result = $this->blog->getBlog(true);
    }

    public function upload_image(Request $request)
    {
        dd($request->file());
    }
}
