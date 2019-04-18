<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/17
 * Time: 20:00
 */

namespace App\Http\Controllers\Admin;


use App\Models\DataModels\TypeModel;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function create()
    {
        $data = (new TypeModel())->getType();
        return view('admin/blog/create')->with(['data'=>$data]);
    }

    public function insert(Request $request)
    {
        $info = $request->all();

        $data = [

        ];
    }

    public function upload_image(Request $request)
    {
        dd($request->file());
    }
}
