<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2018/11/21
 * Time: 15:42
 * 随机生成身份证号码
 */
namespace App\Traits;

use App\Models\AreaCodeModel;

trait NewIdcard
{


    /**
     * @var int 省份证默认是18位
     */
    protected $config = 18;


    /**
     * @var int 一次生成个数
     */
    protected $number = 15;


    /**
     * 外部调用方法
     * @param $area_code
     * @param $year
     * @param $month
     * @param $day
     * @param $sex
     * @param int $config
     * @return array
     */
    public function createIdcard($area_code,$year,$month,$day,$sex,$config=18)
    {
        $arr= $this->newCard($area_code,$year,$month,$day,$sex,$config);

        /**
         * 怎么调用生成器？？？
         */
        return $arr;
    }

    /**
     * 拼接随机号码的生成
     * @param $param
     * @return array
     */
    private function newCard($area_code,$year,$month,$day,$sex,$config)
    {
       if ($this->config != $config) {
           return ['static' => ERROR, 'info' => '不满足要求'];
       }
       $result = $this->getProvince($area_code);
       $newIDArr = [];
       if ($result['count'] >0) {
            foreach ($result['result'] as $k => $v) {
                $time = $this->getTime($year,$month,$day);
                $sexs = $this->getSex($sex);
                $code = $this->random();
                $idCord = $v['area_code'] . $time .$code.$sexs;
                if(strlen($idCord) != 18) {
                    return ['static' => ERROR, 'info' => '随机生成身份证失败'];
                }
                array_push($newIDArr,$idCord);
            }
        }
       return ['static' => SUCCESS,'info' => '成功生成省份证号码','list' => ['idcord' => $newIDArr]];
    }

    /**
     * 随机生成一个字符串
     * @param int $option
     * @param string $str
     * @return string
     */
    private function random($option = 3,$str = '0123456789')
    {
        $len = strlen($str);
        $code = '';
        for ($i=0; $i<$option; $i++) {
            $code .= $str[mt_rand(0,$len-1)];
        }
        return $code;
    }

    /**
     * 得到前六位区号
     * @param $param
     * @return mixed
     */
    private function getProvince($area_code)
    {
        $areaCodeModel = new AreaCodeModel();
        if (empty($area_code)) {
            $result = [];
            for ($i=0; $i<$this->number; $i++) {
                $id = mt_rand(1,6154);
                $getId = $areaCodeModel->where('id','=',$id)->select('area_code')->first();
                $result[] = $getId;
            }
            $count  = $this->number;
        } else {
            $result = $areaCodeModel->where('city_name','like',"%$area_code%")->select('area_code')->get();
            $count  = $areaCodeModel->where('city_name','like',"%$area_code%")->select('area_code')->count();
        }

        return ['result'=>$result,'count'=>$count];

    }

    /**
     * 得到时间组合拼接
     * @param $year
     * @param $month
     * @param $day
     * @return string
     */
    private function getTime($year,$month,$day)
    {
        $newTime =date('Y-m-d',time());
        $newTimeArr = explode('-',$newTime);
        if (!empty($year)) {
            if ($year > $newTimeArr[0]) {
                $year = mt_rand(((int)$newTimeArr[0]-100),$newTimeArr[0]);
            }
        } else {
            $year = mt_rand(((int)$newTimeArr[0]-100),$newTimeArr[0]);
        }

        if (empty($month)) {
            $month = mt_rand(1,12);
        }

        if (empty($day)) {
            switch ($month) {
                case 1:
                    $month = '01';
                    $day = mt_rand(1,31);
                    break;
                case 2:
                    $month = '02';
                    $day = mt_rand(1,29);
                    break;
                case 3:
                    $month = '03';
                    $day = mt_rand(1,31);
                    break;
                case 4:
                    $month = '04';
                    $day = mt_rand(1,30);
                    break;
                case 5:
                    $month = '05';
                    $day = mt_rand(1,31);
                    break;
                case 6:
                    $month = '06';
                    $day = mt_rand(1,30);
                    break;
                case 7:
                    $month = '07';
                    $day = mt_rand(1,31);
                    break;
                case 8:
                    $month = '08';
                    $day = mt_rand(1,31);
                    break;
                case 9:
                    $month = '09';
                    $day = mt_rand(1,30);
                    break;
                case 10:
                    $day = mt_rand(1,31);
                    break;
                case 11:
                    $day = mt_rand(1,30);
                    break;
                case 12:
                    $day = mt_rand(1,31);
                    break;
            }
        }

        switch ($day) {
            case 1:
                $day = '01';
                break;
            case 2:
                $day = '02';
                break;
            case 3:
                $day = '03';
                break;
            case 4:
                $day = '04';
                break;
            case 5:
                $day = '05';
                break;
            case 6:
                $day = '06';
                break;
            case 7:
                $day = '07';
                break;
            case 8:
                $day = '08';
                break;
            case 9:
                $day = '09';
                break;
        }
        return $year.$month.$day;
    }

    /**
     * 得到最后一位随机数
     * @param $sex
     * @param string $str
     * @return mixed
     */
    public function getSex($sex,$str='0123456789X')
    {
        if (empty($sex)) {
            $str = str_shuffle($str);
            $len = strlen($str);
            $index = mt_rand(0,$len-1);
            $sex =$str[$index];
        }

        return $sex;
    }
}