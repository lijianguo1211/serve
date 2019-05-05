<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 19:41
 */

namespace App\Http\Controllers\Admin;


use App\Models\DataModels\AskContentModel;
use Illuminate\Http\Request;

class AskContentController extends BaseController
{
    private $ask;

    private $param;

    public function __construct(AskContentModel $ask, Request $request)
    {
        $this->ask = $ask;
        $this->param = $request->all();
    }

    public function index()
    {
        return view('admin/ask/index');
    }

    public function insert()
    {
        $data = [
            'title'    => $this->param['title'],
            'content'  => $this->param['content'],
            'url_path' => $this->param['url_path'],
            'url_name' => $this->param['url_name']
        ];

        $result = $this->ask->add($data);

        if (!$result) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/ask/index');
    }
}
