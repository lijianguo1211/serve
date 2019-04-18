<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/18
 * Time: 14:19
 */

namespace App\Models\DataModels;


class HeaderModel extends Model
{
    protected $table = "headers";

    protected $primaryKey = 'id';

    protected $fillable = ['title','url','priority','type'];

    /**
     * @param array $data
     * @return mixed
     */
    public function add(array $data)
    {
        $result = $this::create($data);

        return $result;
    }

    /**
     * @param bool $first
     * @param int $where
     * @return mixed
     */
    public function getHeaders($first = false,int $where = 0)
    {
        if ($first == false) {
            $result = $this->select('title','url','type','priority')->where('id','=',$where)->first();
        } else {
            $result = $this->orderBy('created_at','DESC')->get()->toArray();
        }
        return $result;
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function submitEdit(int $id, array $data)
    {
        try {
            $result = $this->where('id','=',$id)->update($data);
        } catch (\Exception $e) {
            \Log::info('header 更新数据失败：'.$e->getMessage());
            $result = false;
        }

        return $result;
    }

    /**
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

    public function getIndexHeader(int $type=0)
    {
        $result = $this->select('title','url')->where('type','=',$type)->orderBy('priority','DESC')->limit(5)->get()->toArray();

        return $result;
    }
}
