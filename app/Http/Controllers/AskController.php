<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 16:00
 */

namespace App\Http\Controllers;

use App\Models\DataModels\HeaderModel;
use App\Models\DataModels\ImageModel;


class AskController extends BaseController
{
    private $ack;

    public function __construct()
    {

    }

    public function index()
    {
        $header = (new HeaderModel())->getIndexHeader();
        $headerResult = (new ImageModel())->getHeaderIndex();
        return view('ask/index')->with(['header'=>$header,'result' => $headerResult]);
    }
}
