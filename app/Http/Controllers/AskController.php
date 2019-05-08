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

    private $header;

    private $headerResult;

    public function __construct(AskContentModel $ask)
    {
        $this->ask = $ask;
        $this->header = (new HeaderModel())->getIndexHeader();
        $this->headerResult = (new ImageModel())->getHeaderIndex();

    }

    public function index()
    {
        $ask = $this->ask->getFirstData();
        return view('ask/index')->with(['header'=>$this->header,'result' => $this->headerResult,'ask'=>$ask]);
    }

    public function createIndex()
    {
        $ask = $this->ask->getFirstData();
        return view('ask/create_index')->with(['header'=>$this->header,'result' => $this->headerResult,'ask'=>$ask]);
    }
}
