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
    }

    public function valiImg()
    {

    }

    public function addImg(array $data)
    {
        try {
            $result = $this::create($data);
        } catch (\Exception $e) {
            \Log::error('热点图片添加失败：'.$e->getMessage());
            $result = false;
        }

        return $result;
    }

    public function getHeaderIndex()
    {
        $result = $this->select('users.username','types.name','image.title','image.content','image.label','image.image_path')
            ->join('users','image.user_id','=','users.id')
            ->join('types','image.label','=','types.id')
            ->where('image.is_to_examine','=',0)
            ->where('image.is_delete','=',0)
            ->orderBy('image.created_at','DESC')
            ->limit(2)
            ->get()
            ->toArray();

        return $result;
    }
}
