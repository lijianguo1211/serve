<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:53
 */

namespace App\Models\DataModels;


class BlogContentModel extends Model
{
    protected $table = "blog_content";

    protected $primaryKey = 'id';

    /*public function blogs()
    {
        return $this->hasOne('App\Models\DataModels\BlogModel');
    }*/
}
