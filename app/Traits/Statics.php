<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/16
 * Time: 16:51
 */
namespace App\Traits;

trait Statics
{
    public function inc()
    {
        static $day = 0;
        $day++;
        echo $day;
    }

    public static function getStaticValue()
    {
        $time = time();
        echo '现在是' . date('Y',$time) . '年' . "<br />";
        echo '现在是' . date('m',$time) . '月' . "<br />";
        echo '现在是' . date('d',$time) . '日' . "<br />";
        echo '现在是' . date('H',$time) . '时' . "<br />";
        echo '现在是' . date('i',$time) . '分' . "<br />";
        echo '现在是' . date('s',$time) . '秒' . "<br />";
    }
}