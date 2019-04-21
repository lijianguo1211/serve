<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 21:03
 */

namespace App\Http\Controllers;

use App\Models\DataModels\HeaderModel;

class ImgController
{
    private $img;

    public function __construct()
    {

    }

    public function index()
    {
        $header = (new HeaderModel())->getIndexHeader();
        return view('img/index')->with(['header'=>$header]);
    }
}