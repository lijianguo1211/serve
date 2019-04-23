<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/23
 * Time: 14:11
 */

namespace App\Models\DataModels;


use Illuminate\Support\Facades\DB;

class CommentModel extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'id';

    protected $fillable = ['id','floor_user_id','layer_user_id','blog_id','content','type','created_at'];

    public $timestamps = false;

    /**
     * 提交评论
     * @param array $data
     * @param int $id
     * @return array
     */
    public function addCommments(array $data, int $id):array
    {
        $userId = (new BlogModel())->getUserId($id);

        if (is_null($userId)) {
            return $result = ['status'=>MYSQL_RESULT_IS_EMPTY,'info'=>'传递参数查询楼主不存在'];
        }

        $user = DB::table('users')->select('username')->where('id','=',$userId->user_id)->first();

        $data['floor_user_id'] = $userId->user_id;
        $data['blog_id'] = $id;
        $data['type'] = 0;
        $data['created_at'] = time();

        try {
            $this::create($data);
            $result = ['status'=>MYSQL_INSERT_IS_SUCCESS,'info'=>'success','data'=>['user'=>$user->username,'time'=>date('Y-m-d H:i:s',$data['created_at'])]];
        } catch (\Exception $e) {
            \Log::error('插入评论失败：'.$e->getMessage());
            $result = ['status'=>MYSQL_INSERT_IS_ERROR,'info'=>'插入评论失败'];
        }

        return $result;
    }

    public function getComments(int $id)
    {
        $result = $this->select('users.username','comments.id','comments.floor_user_id','comments.id','comments.layer_user_id','comments.content','comments.created_at')
            ->join('users','comments.layer_user_id','=','users.id')
            ->where('comments.is_delete','=',0)
            ->where('comments.type','=',0)
            ->where('comments.blog_id','=',$id)
            ->groupBy('comments.floor_user_id','comments.layer_user_id','comments.blog_id')
            ->get()
            ->toArray();
        //$result = DB::select("select `users`.`username`, `comments`.`id`, `comments`.`floor_user_id`, `comments`.`layer_user_id`, `comments`.`blog_id`, `comments`.`content`, `comments`.`type`, `comments`.`created_at` from `comments` inner join `users` on `comments`.`layer_user_id` = `users`.`id` where `comments`.`is_delete` = 0 and `comments`.`type` = 0 and `comments`.`blog_id` = ? group by `comments`.`floor_user_id`, `comments`.`layer_user_id`, `comments`.`blog_id`",[$id]);
        return $result;
    }

    public function getCommetsMany(int $blogId, int $luser, int $cuser)
    {
        $result = $this->select('users.username','comments.id','comments.floor_user_id','comments.type','comments.content','comments.created_at')
            ->join('users','comments.layer_user_id','=','users.id')
            ->where('comments.is_delete','=',0)
            ->where('comments.type','=',0)
            ->where('comments.floor_user_id','=',$luser)
            ->where('comments.layer_user_id','=',$cuser)
            ->where('comments.blog_id','=',$blogId)
            ->orderBy('created_at')
            ->get()
            ->toArray();

        foreach($result as $k => $item) {
            $result[$k]['created_at'] = date('Y-m-d H:i:s',$item['created_at']);
        }

        return $result;
    }

}
