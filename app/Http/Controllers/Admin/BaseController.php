<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $name = 'liyi';
    protected $age = 18;
    private $sex = 1;
    private function test1($str=null,$arr=[])
    {
        $str = 'hello world!!!';
        $arr  = [
            'name' => 'liyi',
            'age'  => 18
        ];
        echo '这是【str】'.$str;
        echo '<br />';
        foreach ($arr as $k => $v) {
            echo '这是【k】'.$k . '=>'.$v;
            echo '<br />';
        }
    }

    public function __call($method, $parameters)
    {
        $this->method($parameters);
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name . $this->age . $this->sex;
    }
}
