<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/2/21
 * Time: 10:42
 */

class Fully
{
    protected $str;

    protected $arr = [];

    public function __construct($str)
    {
        $this->str = $str;
        $this->getStringToArray();
    }

    protected function getStringToArray()
    {
        if (strpos($this->str,",")) {
            $this->arr = explode(',',$this->str);
        } elseif (strpos($this->str," ")) {
            $this->arr = explode(' ',$this->str);
        }
        $this->arr = str_split($this->str);
    }

    protected function swap($numA,$numB)
    {
        $tmp = $this->arr[$numA];
        $this->arr[$numA] = $this->arr[$numB];
        $this->arr[$numB] = $tmp;
    }

    protected function fully()
    {
        $count = count($this->arr);
        if ($count <=1) {
            return $this->arr;
        }


    }
}
