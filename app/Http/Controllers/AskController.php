<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 16:00
 */

namespace App\Http\Controllers;

use App\Models\DataModels\AskContentModel;
use App\Models\DataModels\HeaderModel;
use App\Models\DataModels\ImageModel;


class AskController extends BaseController
{
    private $ask;

    public function __construct(AskContentModel $ask)
    {
        $this->ask = $ask;
    }

    public function index()
    {
        $header = (new HeaderModel())->getIndexHeader();
        $headerResult = (new ImageModel())->getHeaderIndex();
        $ask = $this->ask->getFirstData();
        return view('ask/index')->with(['header'=>$header,'result' => $headerResult,'ask'=>$ask]);
    }
}
