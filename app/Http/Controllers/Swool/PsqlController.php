<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/7
 * Time: 18:24
 */

namespace App\Http\Controllers\Swool;


use Illuminate\Support\Facades\DB;

class PsqlController
{
    public function index()
    {
        //$this->phoneInfoQuery();
        dd(DB::select("select * from test.phones"));
    }

    /**
     * @TODO 从mr.mr_basephoneinfo得到手机信息，储存到test.phones表里，手机型号是唯一的
     *
     *
     * @return array
     */
    public function phoneInfoQuery()
    {
        $phoneInfo = DB::select("select distinct(model),id,platform_info,osversion from mr_basephoneinfo;");
        if (empty($phoneInfo)) {
            return ['error'=>0];
        }

        if (is_array($phoneInfo) || is_object($phoneInfo)) {
            foreach ($phoneInfo as $item) {
                $result = DB::insert("insert into test.phones (phone_model,platform_info,os_version,mr_basephoneinfo_id) values (?,?,?,?)",[$item->model,$item->platform_info,$item->osversion,$item->id]);
                echo $result . E_ALL;
            }
        }
    }


}
