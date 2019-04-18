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

    protected $fillable = ['title','info','label','user_id'];

    /**
     * 一对一关系选择
     */

    public function blogContent()
    {
        return $this->belongsTo('App\Models\DataModels\BlogContentModel','blog_id');
    }

    public function getBlog()
    {
        $data = $this->select('blogs.id','blogs.title','blogs.created_at','blogs.info','users.username')
            ->join('users','blogs.user_id','=','users.id')
            ->where('blogs.delete_status','=',1)
            ->get()->toArray();
        return $data;
    }

    public function getRelease()
    {
        $data = $this->select('title','created_at','id')->where('delete_status','=',1)->orderBy('created_at','DESC')->limit(6)->get()->toArray();

        return $data;
    }

    public function getDetails($id)
    {
        $data = $this->select('blogs.title','blogs.create_at','blogs.user_id','blogs.info','users.username')
            ->join('users','blogs.user_id','=','users.id')
            ->where('blogs.id','=',$id)
            ->where('blogs.delete_status','=',1)
            ->first();
        return $data;
    }

    public function insertBlog(array $data, array $content)
    {
        $data['user_id'] = 1;
        $content['type'] = 0;
        $blogContent = new BlogContentModel();
        DB::beginTransaction();
        try {
            $gitId = $this->insertGetId($data);

            if ($gitId < 1) {
                $error = json_encode(['status'=>0,'info'=>'写入失败']);
                throw new \Exception($error);
            }

            $content['blog_id'] = $gitId;
            $result = $blogContent::create($content);
            DB::commit();
        } catch (\Exception $e) {
            \Log::error('文章写入失败：'.$e->getMessage());
            DB::rollback();
            $result = false;
        }

        return $result;
    }
}
