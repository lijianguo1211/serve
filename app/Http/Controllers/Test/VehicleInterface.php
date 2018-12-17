<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/12/17
 * Time: 10:47
 */
namespace App\Http\Controllers\Test;

/**
 * 旅游地点及交通工具接口
 * Interface VehicleInterface
 * @package App\Http\Controllers\Test
 */
interface VehicleInterface
{
    public function goRun();

    public function goToTarget();
}