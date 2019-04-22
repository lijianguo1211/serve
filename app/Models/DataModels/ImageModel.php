<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 22:04
 */

namespace App\Models\DataModels;


use Illuminate\Support\Facades\Storage;

class ImageModel extends Model
{


    protected $table = "image";

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'user_id', 'image_path', 'title', 'content', 'label'];

    public function insertImg($fileObj)
    {
        $file = public_path('/upload/hotspot/');

        if (!is_dir($file)) {
            mkdir($file, 0755, true);
        }

        $fileObj->store('', 'upload');
        $imageName = $fileObj->getClientOriginalName();



        $imgDir = $fileObj->getClientOriginalExtension();

        $newImgName = 'hotspot_' . date('Y-m-d_H:i:s', time()) . '_' . uniqid() . '_' . md5(microtime(true)) . '.'.$imgDir;

        // 图片保存路径
        $savePath = '/images/' . $newImgName;
        // Web 访问路径
        $webPath = '/storage/' . $savePath;
        // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在，如果存在直接返回


        if (Storage::disk('my')->has($savePath)) {
            return response()->json(['path' => $webPath]);
        }
        // 否则执行保存操作，保存成功将访问路径返回给调用方
        if ($fileObj->storePubliclyAs('images', $newImgName, ['disk' => 'my'])) {
            return response()->json(['path' => $webPath]);
        }
    }

    public function valiImg()
    {

    }
}
