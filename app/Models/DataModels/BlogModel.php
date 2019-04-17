<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:35
 */

namespace App\Models\DataModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogModel extends Model
{
    protected $table = "blogs";

    protected $primaryKey = 'id';

    /**
     * 一对一关系选择
     */

    public function blogContent()
    {
        return $this->belongsTo('App\Models\DataModels\BlogContentModel','blog_id');
    }

    public function getBlog()
    {
        //$data = $this->where('delete_status','=',1)->join('inner join','blogs.id','=','blog_content.blog_id')->get()->toArray();
        $data = $this->select('blogs.id','blogs.title','blogs.create_at','blog_content.content','users.username')
            ->join('blog_content','blogs.id','=','blog_content.types_id')
            ->join('users','blogs.user_id','=','users.id')
            ->where('blog_content.type','=',0)
            ->where('blogs.delete_status','=',1)
            ->get()->toArray();
        return $data;
    }

    public function getRelease()
    {
        $data = $this->select('title','create_at','id')->where('delete_status','=',1)->orderBy('create_at','DESC')->limit(6)->get()->toArray();

        return $data;
    }

    public function getDetails($id)
    {
        $data = $this->select('blogs.title','blogs.create_at','blogs.user_id','blog_content.content','users.username')
            ->join('users','blogs.user_id','=','users.id')
            ->join('blog_content','blogs.id','=','blog_content.types_id')
            ->where('blogs.id','=',$id)
            ->where('blog_content.type','=',0)
            ->where('blogs.delete_status','=',1)
            ->first();
        return $data;
    }
}
