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

    protected $fillable = ['id','content'];

    /**
     * 得到显示
     * @param bool $index
     * @return mixed
     */
    public function getRieghtTops($index = false)
    {
        $data = $this->select('content')->orderBy('created_at','DESC');
        if ($index == false) {
            $data = $data->limit(1)->first();
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
    public function insertRightTops($data)
    {
        $result = $this::create($data);

        return $result;
    }
}
