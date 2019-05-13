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

    /*public function blogContent()
    {
        return $this->belongsTo('App\Models\DataModels\BlogContentModel','blog_id');
    }*/

    public function getBlog($admin = false)
    {

        if ($admin) {
            $data = $this->select('types.name','blogs.id','blogs.title','blogs.created_at','blogs.info','users.username','blogs.reading_volume','blogs.info','blogs.label')
                ->join('types','blogs.label','=','types.id')
                ->join('users','blogs.user_id','=','users.id')
                ->where('blogs.delete_status','=',0)
                ->orderBy('blogs.created_at','desc')
                ->get()
                ->toArray();
        } else {
            $data = $this->select('blogs.reading_volume','types.name','blogs.id','blogs.title','blogs.created_at','blogs.info','users.username')
                ->join('users','blogs.user_id','=','users.id')
                ->join('types','blogs.label','=','types.id')
                ->where('blogs.delete_status','=',0)
                ->orderBy('blogs.created_at','desc')
                ->limit(10)
                ->get()->toArray();
        }



        return $data;
    }

    public function getRelease()
    {
        $data = $this->select('title','created_at','id')->where('delete_status','=',0)->orderBy('created_at','DESC')->limit(6)->get()->toArray();

        return $data;
    }

    public function getDetails($id)
    {
        try {
            $this::where('id','=',$id)->increment('reading_volume');
        } catch (\Exception $e) {
            \Log::error('阅读量更新失败');
        }
        $data = $this->select('blogs.title','blogs.id','blogs.created_at','blogs.user_id','blogs.info','users.username','blog_content.content_md')
            ->join('blog_content','blogs.id','=','blog_content.blog_id')
            ->join('users','blogs.user_id','=','users.id')
            ->where('blogs.id','=',$id)
            ->where('blog_content.type','=',0)
            ->where('blogs.delete_status','=',0)
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
                $error = '写入得到文章ID失败';
                throw new \Exception($error);
            }

            $content['blog_id'] = $gitId;
            //dd($content);
            $result = $blogContent::create($content);
            DB::commit();
        } catch (\Exception $e) {
            \Log::error('文章写入失败：'.$e->getMessage());
            DB::rollback();
            $result = false;
        }

        return $result;
    }

    /**
     * 推荐阅读【阅读量排行取前六】
     * @return mixed
     */
    public function getValue()
    {
        $result = $this->select('id','title')
            ->where('delete_status','=','0')
            ->orderBy('created_at','DESC')
            ->limit(6)
            ->get()
            ->toArray();

        return $result;
    }

    /**
     * 由博客ID得到发布者的用户ID
     * @param int $id
     * @return mixed
     */
    public function getUserId(int $id)
    {
        $result = $this->select('user_id')->where('id','=',$id)->first();

        return $result;
    }
}
