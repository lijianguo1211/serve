<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;

use App\Models\DataModels\TypeModel;
use App\Models\DataModels\ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImgController extends BaseController
{
    private $img;

    public function __construct(ImageModel $model)
    {
        $this->img = $model;
    }

    public function create()
    {
        $data = (new TypeModel())->getType();
        return view('admin/img/create')->with(['data' => $data]);
    }

    public function add(Request $request)
    {
        $info = $request->all();

        if(!$request->has('img_path')) {
            return back()->with(['status'=>0,'msg'=>'图片路径没有']);
        }

        $data = [
            'user_id' => 1,
            'image_path' => $info['img_path'],
            'title'      => $info['title'],
            'content'    => $info['content'],
            'label'      => $info['label']
        ];

        $result = $this->img->addImg($data);

        if(!$result) {
            return back()->with(['status'=>0,'msg'=>'插入数据失败']);
        }
        return redirect('admin/image/index');
    }

    public function index()
    {
        dd(123456);
    }

    public function upload(Request $request)
    {
        $info = $request->file('file');

        if(!$info->isValid()) {
            return $data = json_encode(['status'=>1000,'info' => '验证失败']);
        }

        $fileType = $info->getType();

        if ($fileType != 'file') {
            return $data = json_encode(['status'=>1001,'info' => '必输是上传文件']);
        }

        $size = $info->getClientSize();

        if ($size > 1024*1024) {
            return $data = json_encode(['status'=>1002,'info' => '文件超出限制']);
        }

        $systemType = ['png','gif','jpg','jpeg'];


        $type = $info->getClientMimeType();//image/jpeg

        $type = strtolower(explode('/',$type)[1]);

        if (!in_array($type,$systemType)) {
            return $data = json_encode(['status'=>1002,'info' => '上传图片类型支持'.json_encode($systemType)]);
        }


        $ext = $info->getClientOriginalExtension();
        //$name = $info->getClientOriginalName();

        $newImgName = 'hotspot_' . date('Y-m-d_H:i:s', time()) . '_' . uniqid() . '_' . md5(microtime(true)) . '.'.$ext;

        $file = public_path('/upload/hotspot/');

        if (!is_dir($file)) {
            mkdir($file, 0755, true);
        }
        try {
            $info->move($file,$newImgName);
            $url = 'http://lglg.xyz/upload/hotspot/'.$newImgName;
            return json_encode(['status'=>200,'info'=>'成功','url'=>$url]);
        } catch (\Exception $e) {
            $e1 = $info->getError();
            $e2 = $info->getErrorMessage();
            \Log::error($e1."\n".$e2."\n".$e->getMessage());
            $result = $e->getMessage();
            return json_encode(['status' => 1003, 'info' => $result]);
        }
    }
}
