<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:35
 */

namespace App\Models\DataModels;

use Illuminate\Database\Eloquent\Model;

class BlogModel extends Model
{
    protected $table = "blogs";

    /**
     * 一对一关系选择
     */

    public function blogContent()
    {
        return $this->belongsTo('App\Models\DataModels\BlogContentModel');
    }

    public function getBlog()
    {
        $data = $this->where('delete_status','=',1)->get()->toArray();
        $data = $this->blogContent();
        return $data;
    }
}
