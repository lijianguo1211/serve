<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/16
 * Time: 17:06
 */

namespace App\Http\Controllers;

use App\Models\DataModels\AskContentModel;
use App\Models\DataModels\BlogModel;
use App\Models\DataModels\CommentModel;
use App\Models\DataModels\HeaderModel;
use App\Models\DataModels\ImageModel;
use App\Models\DataModels\RightTopsModel;
use App\User;
use Illuminate\Http\Request;
use App\Baidu\Baidu;
use EndaEditor;
use Illuminate\Support\Facades\URL;

class IndexController extends BaseController
{
    /**
     * @var BlogModel
     */
    private $obj;

    /**
     * @var Request
     */
    private $params;

    private $askIndex;

    /**
     * IndexController constructor.
     * @param BlogModel $blog
     * @param Request $request
     */
    public function __construct(BlogModel $blog,Request $request,AskContentModel $askIndex)
    {
        $this->obj = $blog;
        $this->params = $request;
        $this->askIndex = $askIndex->getFirstData();
    }

    /**
     * 首页展示
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->obj->getBlog();
        $getRelease = $this->obj->getRelease();
        $getValue = $this->obj->getValue();
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        $header = (new HeaderModel())->getIndexHeader();
        $right = (new HeaderModel())->getIndexHeader(1);
        $headerResult = (new ImageModel())->getHeaderIndex();
        return view('home')->with([
            'blogs'=>$result,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue,
            'result' => $headerResult,
            'ask'    => $this->askIndex,
        ]);
    }

    /**
     * 详情页面
     */
    public function details($id)
    {
        if (!is_int($id)) {
            $id = (int)$id;
        }
        $data = $this->obj->getDetails($id);
        $getRelease = $this->obj->getRelease();
        $getValue = $this->obj->getValue();
        $reghtTops = (new RightTopsModel())->getRieghtTops();
        $header = (new HeaderModel())->getIndexHeader();
        $right = (new HeaderModel())->getIndexHeader(1);
        $headerResult = (new ImageModel())->getHeaderIndex();
        $comments = (new CommentModel())->getComments($id);
        return view('detail')->with([
            'details'=>$data,
            'release'=>$getRelease,
            'reghtTops'=>$reghtTops,
            'header'=>$header,
            'right'=>$right,
            'value'=>$getValue,
            'result' => $headerResult,
            'comments' => $comments,
            'ask' => $this->askIndex
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return false|string
     */
    public function ajaxComment(Request $request,int $id)
    {
        $info = $request->all();
        $data = [
            'content'   => $info['content'],
            'layer_user_id' => $info['l_user_id']
        ];
        $result = (new CommentModel())->addCommments($data, $id);

        if ($result['status'] != MYSQL_INSERT_IS_SUCCESS) {
            return json_encode($result);
        }

        return json_encode($result);
    }

    /**
     * @param int $id
     * @return false|string
     */
    public function ajaxGetComment(int $id)
    {
        $luser = $this->params['luser_id'];
        $cuser = $this->params['cuser_id'];

        $result = (new CommentModel())->getCommetsMany($id,$luser,$cuser);

        if (empty($result)) {
            return json_encode(['status'=>MYSQL_SELECT_IS_ERROR,'info'=>'查询数据错误']);
        }

        return json_encode(['status'=>MYSQL_SELECT_IS_SUCCESS,'info'=>'success','data'=>$result]);
    }


    public function testHash()
    {
        url()->current();

        echo URL::current();
        echo "<br />";
        echo URL::class;
        echo "<br />";
        echo url()->full();
        echo "<br />";
        echo url()->previous();
        echo "<br />";
        echo url()->route('login');
        echo "<br />";
        echo url()->action('IndexController@liyi');
        echo "<br />";
        echo url()->asset('upload/hotspot/1.jpg');
        echo "<br />";
        echo url()->asset('upload/hotspot/2.jpg');echo "<br />";
        echo url()->to('upload/hotspot/2.jpg');
        echo "<br />";
        echo route('test.index',['id'=>12]);
        echo "<br />";
        $user = (new User())->get();
        foreach($user as $item) {
            echo route('test.index',['id'=>$item]);
            echo "<br />";
        }
    }

    public function testHash1()
    {

    }

    public function getBaiduCode(Request $request)
    {
        $code = $request->get('code');
        $state = $request->get('state');
        $baidu = new Baidu(config('socialite.baidu.apiKey'),config('socialite.baidu.secretKey'),config('socialite.baidu.redirect_uri'));

    }

    public function test()
    {
        return view('test');
    }

    public function liyi()
    {
        $content = file_get_contents(storage_path('1.md'));
        $content = EndaEditor::MarkDecode($content);
        echo $content;
    }

}

