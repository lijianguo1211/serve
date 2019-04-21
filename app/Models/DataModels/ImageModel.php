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
}