<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-04-21
 * Time: 22:02
 */

namespace App\Http\Controllers\Admin;


use App\Models\DataModels\ImageModel;

class ImgController extends BaseController
{
    private $img;

    public function __construct(ImageModel $model)
    {
        $this->img = $model;
    }

    public function create()
    {
        return view('admin/img/create');
    }
}