<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 19:34
 */

namespace App\Models\DataModels;


class AskContentModel extends Model
{
    protected $table = "ask_content";

    protected $primaryKey = 'id';

    protected $fillable = ['title','id','content','url_path','url_name'];

    public function add(array $data)
    {
        try {
            $result = $this::create($data);
        } catch(\Exception $e) {
            \Log::error('提问板块插入出错：'.$e->getMessage());
            $result = false;
        }

        return $result;
    }

    public function getFirstData():array
    {
        $result = $this->select('title','content','url_path','url_name')->orderBy('created_at','desc')->limit(1)->get()->toArray();

        return $result;
    }
}
