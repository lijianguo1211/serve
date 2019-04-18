<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 15:06
 */

namespace App\Models\DataModels;


class RightTopsModel extends Model
{
    protected $table = "right_tops";

    protected $primaryKey = 'id';

    protected $fillable = ['content','title'];

    /**
     * 得到显示
     * @param bool $index
     * @return mixed
     */
    public function getRieghtTops($index = false,$id = false)
    {
        $data = $this->orderBy('created_at','DESC');
        if ($index == false) {
            if ($id != false) {
                $data = $data->select('id','title','content')->where('id','=',$id)->first();
            }
                $data = $data->select('id','title','content')->limit(1)->first();
        } else {
            $data= $data->get()->toArray();
        }

        return $data;
    }

    /**
     * 添加每日一语
     * @param $data
     * @return mixed
     */
    public function insertRightTops(array $data)
    {
        try {
            $result = $this::create($data);
        } catch (\Exception $e) {
            \Log::error('添加每日一语失败：'.$e->getMessage());
            $result = false;
        }

        return $result;
    }

    /**
     * 编辑提交处理
     * @param array $arr
     * @param int $id
     * @return mixed
     */
    public function submitEdit(array $arr, int $id)
    {
        $result = $this->where('id','=',$id)->update($arr);

        return $result;
    }

    /**
     * 删除每日一句
     * @param int $id
     * @return bool
     */
    public function deletes(int $id)
    {
        try {
            $result = $this->where('id','=',$id)->delete();
        } catch (\Exception $e) {
            \Log::error('删除每日一句失败：'.$e->getMessage());
            $result = false;
        }

        return $result;
    }
}
