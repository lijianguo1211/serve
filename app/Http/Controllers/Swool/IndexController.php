<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/3/7
 * Time: 14:11
 */

namespace App\Http\Controllers\Swool;

use Carbon\Carbon;


class IndexController
{
    public function index()
    {
        echo Carbon::now();
        echo "<hr />";
        $this->save();
    }

    public function save()
    {
        echo '开始的天startDay1551283200>>>>> ' . date('Y-m-d H:i:s','1551283200');
        echo "<hr />";
        echo '开始的小时startHour1551333600>>>>> ' . date('Y-m-d H:i:s','1551333600');
        echo "<hr />";
        echo '结束的天endDay1551888000>>>>> ' . date('Y-m-d H:i:s','1551888000');
        echo "<hr />";
        echo '结束的小时endHour1551938400>>>>> ' . date('Y-m-d H:i:s','1551938400');
        echo "<hr />";
        echo 'start time:2019-02-28 14:54:41, end time:2019-03-07 14:54:41 ';

        echo "<hr />";
        echo '开始的天startDay1551369600>>>>> ' . date('Y-m-d H:i:s','1551369600');
        echo "<hr />";
        echo '开始的小时startHour1551340800>>>>> ' . date('Y-m-d H:i:s','1551340800');
        echo "<hr />";
        echo '结束的天endDay1551888000>>>>> ' . date('Y-m-d H:i:s','1551888000');
        echo "<hr />";
        echo '结束的小时endHour1551942000>>>>> ' . date('Y-m-d H:i:s','1551942000');
        echo "<hr />";
        echo 'start time:2019-02-28 15:14:38, end time:2019-03-07 15:14:38 ';
    }

    public function timeTest()
    {
        $startTime = 1551628800;
        $endTime   = 1551939541;
        list($startDay, $endDay) = $this->getDayTime($startTime, $endTime);
        list($startHour, $endHour) = $this->getHourTime($startTime, $endTime);
        var_dump(date('Y-m-d H:i:s',$startDay));
        echo "<hr />";
        var_dump(date('Y-m-d H:i:s',$endDay));
        echo "<hr />";
        var_dump(date('Y-m-d H:i:s',$startHour));
        echo "<hr />";
        var_dump(date('Y-m-d H:i:s',$endHour));
        echo "<hr />";
    }

    private function getDayTime($startTime, $endTime)
    {
        $start = Carbon::createFromTimestamp($startTime); // 开始时间
        $end = Carbon::createFromTimestamp($endTime); // 结束时间

        $startDay = $start->startOfDay()->getTimestamp();
        $endDay = $end->startOfDay()->getTimestamp();

        return [$startDay, $endDay];
    }

    private function getHourTime($startTime, $endTime)
    {
        $start = Carbon::createFromTimestamp($startTime); // 开始时间
        $end = Carbon::createFromTimestamp($endTime); // 结束时间

        $startHour = $start->startOfHour()->getTimestamp(); // 开始的整小时
        $endHour = $end->startOfHour()->getTimestamp(); // 结束的整小时

        return [$startHour, $endHour];
    }
}
