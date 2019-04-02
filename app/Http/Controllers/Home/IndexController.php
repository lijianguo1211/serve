<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\One;
use App\Traits\Two;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Xescel\XLSXWriter;

//define ('M_PI', 3.1415926535898);
class IndexController extends Controller
{
    use One,Two;
    public function index()
    {
        return view('home/index/index');
    }

    public function cliDownLoadExcel()
    {
        exec('php F:\LL\serve\app\Excel\cliDownloadExcel.php');
    }



    public function downloadExcel($type = false)
    {
        $writer = new XLSXWriter();
        if ($type) {
            $writer->writeSheetHeader('users', ['ID'=>'integer','用户名'=>'string','密码'=>'string','邮箱'=>'string','年龄'=>'integer','创建时间'=>'date','修改时间'=>'date']);
            DB::table('users')->orderBy('id')->chunk(10,function($users) use($writer) {
                $n = 0;
                foreach ($users as $user) {
                    $user->create_at = date('Y-m-d H:i:s',$user->create_at);
                    $user->update_at = date('Y-m-d H:i:s',$user->update_at);
                    $writer->writeSheetRow('users'.$n++, (array)$user);
                }
            });
            $writer->writeToFile(__DIR__.'users'.mt_rand(100,999).'.xlsx');
            echo 'success';
        } else {
            ini_set('max_execution_time', 0);
            $writer->writeSheetHeader('users_bak', ['ID'=>'integer','用户名'=>'string','密码'=>'string','邮箱'=>'string','昵称'=>'string','创建时间'=>'date','修改时间'=>'date']);
            DB::table('users_bak')->where('id','<',100000)->orderBy('id')->chunk(10,function($users) use($writer) {
                $i = 0;
                foreach ($users as $user) {
                    $user->create_at = date('Y-m-d H:i:s',$user->create_at);
                    $user->update_at = date('Y-m-d H:i:s',$user->update_at);
                    $writer->writeSheetRow('users0'.$i++, (array)$user);
                }
            });
            $writer->writeToFile(__DIR__.'users_bak'.mt_rand(100,999).'.xlsx');
            echo 'success';
        }


    }

    public function test()
    {
        $this->indexTestOne();
        $this->indexTestTwo();
        echo "这是普通类 IndexController 的test方法 <br />";
        $point_lat = '30.447065';
        $target_lat = '30.449494202931';
        $point_lon = '114.479429';
        $target_lon = '114.47977978815';
        $distance = 6370996.81 * acos(cos($point_lat * M_PI / 180) * cos($target_lat * M_PI / 180) * cos($point_lon * M_PI / 180 - $target_lon * M_PI / 180) + sin($point_lat * M_PI / 180) * sin($target_lat * M_PI / 180));
        return round($distance);
    }

    public function edit()
    {
        (new SonController())->edit();
    }

    public function save()
    {
        (new FivesController())->save();
        echo "<br />";
        (new FivesController())->store();
    }

    public function save1()
    {
        (new SixController())->save();
        echo "<br />";
        (new SixController())->store();
        echo "<br />";
        (new SixController())->save1();
        echo "<br />";
        (new SixController())->store1();
    }

    public function sayHello()
    {
        (new EightController())->sayWorld();
    }

    public function sayHello1()
    {
        (new NineController())->sayHello();
    }

    public function sayHelloWorld()
    {
        (new ThirteenController())->sayHello();
        (new ThirteenController())->sayWorld();
    }

    public function sayXiaoLiZi()
    {
        (new FifteenController())->getValue();
    }

    public function sayStatic()
    {
        (new Static1Controller())->inc();
        echo "<br />";
        (new Static2Controller())->inc();
    }

    public function sayTime()
    {
        Static1Controller::getStaticValue();
        Static2Controller::getStaticValue();
    }

    public function sayAttributes()
    {
        print (new AttributesController())->name;
    }

}
