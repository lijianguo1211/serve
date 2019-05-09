<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/5/5
 * Time: 16:00
 */

namespace App\Http\Controllers;

use App\Models\DataModels\AskContentModel;
use App\Models\DataModels\AskModel;
use App\Models\DataModels\HeaderModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AskController extends BaseController
{
    private $ask;

    private $askContent;

    private $header;

    private $askIndex;

    public function __construct(AskContentModel $askContent,AskModel $ask)
    {
        $this->middleware('auth')->except('index');
        $this->askContent = $askContent;
        $this->ask = $ask;
        $this->header = (new HeaderModel())->getIndexHeader();
        $this->askIndex = $this->askContent->getFirstData();
    }

    public function index()
    {
        $resultAsk = $this->ask->getIndexs();
        return view('ask/index')->with([
            'header'=>$this->header,
            'ask'=>$this->askIndex,
            'askResult' => $resultAsk
        ]);
    }

    public function createIndex()
    {
        return view('ask/create_index')->with(['header'=>$this->header,'ask'=>$this->askIndex]);
    }

    public function insert(Request $request)
    {
        $info = $request->all();
        $validator = Validator::make($info, [
            'title' => 'required|max:50',
            'label' => 'required|max:50',
            'content' => 'required',
        ],[
           'title.required' => '主题必须填写',
           'title.max' => '50个字符以内',
           'label.required' => '分类必须填写',
           'label.max' => '50个字符以内',
           'content.required' => '内容必须填写',
        ]);

        if ($validator->fails()) {
            return redirect('ask/create/index')
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'title' => $info['title'],
            'label' => $info['label'],
            'content' => $info['content'],
            'user_id' => Auth::user()->id
        ];

        $result = $this->ask->add($data);

        if (!$result) {
            return back()->with(['info'=>0,'error'=>'插入失败']);
        }
        return redirect('questions');
    }
}
