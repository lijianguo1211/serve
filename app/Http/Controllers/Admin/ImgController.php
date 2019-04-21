<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;

use App\Models\DataModels\TypeModel;
use App\Models\DataModels\ImageModel;
use Illuminate\Http\Request;

class ImgController extends BaseController
{
    private $img;

    public function __construct(ImageModel $model)
    {
        $this->img = $model;
    }

    public function create()
    {
        $data = (new TypeModel())->getType();
        return view('admin/img/create')->with(['data' => $data]);
    }

    public function add(Request $request)
    {
        $info = $request->all();

        dd($info);
    }

    public function upload(Request $request)
    {
        $info = $request->file();
        $this->img->insertImg($info['file']);
        dd($info['file']);
    }
}