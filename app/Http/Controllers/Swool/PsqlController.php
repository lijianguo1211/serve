<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/7
 * Time: 18:24
 */

namespace App\Http\Controllers\Swool;


use Illuminate\Support\Facades\DB;
use App\Excel\XLSXWriter;


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

    public function downloadExcel()
    {
        $xsl = new XLSXWriter();
        $count = DB::table('mr.mr_keyboardinfo')->select(DB::raw("id,collect_target_id,contact_account_type,windows_id,friend_nickname,content,capture_time"))->count();
        static $j = 0;
        for ($i=0; $i<$count; $i+200) {
            $xsl->writeSheetHeader('Sheet'.$j, array('ID'=>'integer','手机标识'=>'string','软件类型'=>'string','发收'=>'integer','昵称' => 'string','内容' => 'string','时间'=>'datetime') );//optional
            $keyBoardInfoData = DB::table('mr.mr_keyboardinfo')->select(DB::raw("id,collect_target_id,contact_account_type,windows_id,friend_nickname,content,capture_time"))
                ->skip($j*(200))//offset
                ->take(200)//limit
                ->get()
                ->toArray();
            foreach($keyBoardInfoData as $k => $v) {
                $xsl->writeSheetRow('Sheet'.$j, (array)$v);
            }
            $j++;
        }
        var_dump(storage_path('/logs/'));
        $xsl->writeToFile(storage_path('/logs/').'keyBoardInfo.xlsx');
        echo '#'.floor((memory_get_peak_usage())/1024/1024)."MB"."\n";
    }
}
