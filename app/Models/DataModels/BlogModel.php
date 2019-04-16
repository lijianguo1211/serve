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
        $data = DB::table('blogs')->select('blogs.title','blogs.create_at','blogs.blog_owner','blog_content.content')->join('blog_content','blogs.id','=','blog_content.blog_id')->where('blogs.delete_status','=',1)->get()->toArray();
        return $data;
    }

    public function getRelease()
    {
        $data = $this->select('title','create_at','id')->where('delete_status','=',1)->orderBy('create_at','DESC')->get()->toArray();

        return $data;
    }
}
