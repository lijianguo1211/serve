<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/9
 * Time: 10:23
 */

namespace App\Models\DataModels;


class AskModel extends Model
{
    protected $table = "ask";

    protected $primaryKey = 'id';

    protected $fillable = ['title','id','content','user_id','label'];

    public function add(array $data)
    {
        try {
            $result = $this::create($data);
        } catch (\Exception $e) {
            \Log::error('发布提问失败：'.$e->getMessage());
            $result = false;
        }
        return $result;
    }

    public function getIndexs():array
    {
        $result = $this->select('ask.title','ask.id','users.username','ask.label','ask.created_at','ask.reading_value')
            ->join('users','ask.user_id','=','users.id')
            ->limit(10)->get()->toArray();
        foreach ($result as $k => $item) {
            $result[$k]['label'] = explode(',',$item['label']);
        }

        return $result;
    }
}
