<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 21:03
 */

namespace App\Http\Controllers;

use App\Models\DataModels\HeaderModel;
use Illuminate\Http\Request;

class ImgController extends BaseController
{
    private $img;

    private $header;

    private $param;

    public function __construct(Request $request)
    {
        $this->header = (new HeaderModel())->getIndexHeader();
        $this->param = $request->all();
    }

    public function index()
    {
        return view('img/index')->with(['header'=>$this->header]);
    }

    public function userIndex()
    {
        return view('img/user_index')->with(['header'=>$this->header]);
    }

    public function upload()
    {
        dd(123456);
    }

    public function delete()
    {
        dd($this->param);
    }
}
