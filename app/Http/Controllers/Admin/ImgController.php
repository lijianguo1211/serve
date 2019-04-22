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

        dd($info);
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


        // 将文件保存到本地 storage/app/public/ 目录下，先判断同名文件是否已经存在，如果存在直接返回
        if (Storage::disk('my')->has($newImgName)) {
            return $data =['status'=>200,'info' => '成功','path' => config('filesystems.disks.my.url').$newImgName];
        }
        try {
            $info->move(storage_path('app/public/upload/'),$newImgName);
            $url = config('filesystems.disks.my.url').$newImgName;
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
