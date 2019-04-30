<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Models\User;
use App\Http\Requests\StoreUserPost;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
    const CLIENT_ID = '8926fa7400f0b75dbe59';

    const CLIENT_SECRET = '0380682246c41063615918092b75923266122c9f';

    const REDIRECT_URL = 'http://localhost:8009/admin/liyi/github/callback';

    private $mailer;

    private $param;

    protected $redirectTo = '/';

    /**
     * UserController constructor.
     * @param \Illuminate\Mail\Mailer $mailer
     */
    public function __construct(Mailer $mailer,Request $request)
    {
        $this->mailer = $mailer;
        $this->param  = $request->all();
    }

    /**
     * Notes:后台登录
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:19
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $github = 'https://github.com/login/oauth/authorize?client_id='.static::CLIENT_ID.'&scope=user:email&redirect_uri='.static::REDIRECT_URL;
        return view('admin/user/index')->with(['github'=>$github]);
    }

    /**
     * Notes:登录提交
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:19
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login()
    {
        $result = Validator::make($this->param,
            [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => '必须填写',
            'username.string'   => '必须是字符串',
            'password.required' => '必须填写',
            'password.string'   => '必须是字符串',
        ]);

        if ($result->fails()) {
            $data = $result->errors()->all();

            dd($data);
        }

        return redirect('admin/index');
    }

    /**
     * Notes:查看管理员列表
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:18
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function list()
    {
        $user_list = User::select(['user_id','user_name','user_account','user_nickname','user_email','user_mobile'])->get();

        if(collect($user_list)->isEmpty()) return back()->with(['status'=>0,'msg'=>'读取数据失败']);
        return view('admin/user/list',compact('user_list'));
    }

    /**
     * Notes:添加管理员显示
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:18
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        //管理员添加页面
        return view('admin/user/add');
    }

    /**
     * Notes:添加管理员处理
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:18
     * @param \App\Http\Requests\StoreUserPost $request
     */
    public function add_admin(StoreUserPost $request)
    {
        //验证数据,接收数据
        $user_name = $request->get('user_name');
        $user_account = $request->get('user_account');
        $user_nickname = $request->get('user_nickname');
        $user_mobile = $request->get('user_mobile');
        $user_email = $request->get('user_email');
        $user_pwd = $request->get('user_pwd');
        $user_rpwd = $request->get('user_rpwd');
        $user_type = $request->get('user_type');
        if($user_pwd !== $user_rpwd) {
            $this->ajaxReturn(['status'=>0,'msg'=>'两次输入密码不一致']);
        }
        if(!$this->regexMobile($user_mobile)) {
            $this->ajaxReturn(['status'=>0,'msg'=>'手机号格式不对']);
        }
        $key = User::getPwdKey();
        $data = [
            'user_name'      => $user_name,
            'user_account'   => $user_account,
            'user_nickname'  => $user_nickname,
            'user_mobile'    => $user_mobile,
            'user_email'     => $user_email,
            'user_pwd'       => Hash::make($user_pwd.config('password_key').$key),
            'user_type'      => $user_type,
            'user_logtime'   => date('Y-m-d H:i:s',time()),
            'user_ip'        => $request->getClientIp(),
            'user_key'       => $key,
        ];
        $result = User::create($data);
        if(!$result) {
            $this->ajaxReturn(['status'=>0,'msg'=>'新增用户失败']);
        }
        $this->ajaxReturn(['status'=>1,'msg'=>'新增用户成功']);
    }

    /**
     * Notes:发送文本邮件
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:17
     * @param $emailData
     */
    public function sendText($emailData)
    {
        //此处为文本内容
        $tag = $this->mailer
            ->raw($emailData['content'],
                function ($message)use ($emailData){
                    $message->subject($emailData['subject']);
                    $message->to($emailData['addr']);
                });
        return $tag;
    }

    /**
     * Notes:发送邮件
     * User: "LiJinGuo"
     * Date: 2018/7/31
     * Time: 20:17
     * @param \Illuminate\Http\Request $request
     */
    public function passwordRetrieve(Request $request)
    {
        //邮件主题
        $subject = $request->get('subject');
        //邮件内容
        $content = $request->get('content');
        //邮件发送地址
        $address = $request->get('address');
        $data = [
            'content'  => $content,
            'subject'  => $subject,
            'addr'     => $address,
        ];
        $result = $this->sendText($data);
        if ($result) {
            $this->ajaxReturn(['status'=>0,'msg'=>'发送失败']);
        } else {
            $this->ajaxReturn(['status'=>1,'msg'=>'发送成功']);
        }
    }

}
