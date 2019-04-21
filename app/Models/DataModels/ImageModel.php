<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 22:04
 */

namespace App\Models\DataModels;


class ImageModel extends Model
{


    protected $table = "image";

    protected $primaryKey = 'id';

    protected $fillable = ['id','user_id','image_path','title','content','label'];

    public function insertImg($fileObj)
    {
        $file = public_path('/upload/hotspot/');

        if (!is_dir($file)) {
            mkdir($file,0755,true);
        }

        $imageName = $fileObj->getClientOriginalName();

        $imgDir = $fileObj->getClientOriginalExtension();

        $newImgName = 'hotspot_'.date('Y-m-d_H:i:s',time()).'_'.uniqid().'_'.md5(microtime(true)).$imgDir;
dd($newImgName);
        $result = $fileObj->move($file,$newImgName);
        dd($result);

    }
}