<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAdminPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends BaseController
{
   /* public function __construct() {
        $this->beforeFilter('csrf', array('on'=>'post'));
    }*/

    //后台登录
    /**
     * Notes:后台登录界面显示
     * User: "LiJinGuo"
     * Date: 2018/8/1
     * Time: 10:57
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin/admin/index');
    }

    /**
     * Notes:后台登录逻辑处理
     * User: "LiJinGuo"
     * Date: 2018/8/10
     * Time: 14:08
     * @param \Illuminate\Http\Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function registerAdmin(Request $request)
    {
        //接收数据StoreAdminPost
        if (!$request->isMethod('post')) {
            return back()->with(['status'=>0,'msg'=>'请求方法错误']);
        }
        $key = trim($request->get('form-username'));
        $value = trim($request->get('form-password'));
        $sw = '';
        if (preg_match('/^0?1[3|4|5|6|7|8][0-9]\d{8}$/',$key)) {
            $sw = 1;//手机登录
        } elseif (preg_match('/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$key)) {
            $sw = 2;//邮箱登录
        } elseif (preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',$key)) {
            $sw = 3;//用户名登录
        }
        $where = '';
        switch ($sw) {
            case 1:
            //手机
                if(!$this->regexMobile($key)) {
                    return back()->with(['status'=>0,'msg'=>'手机号格式不对']);
                }
                $where = 'user_mobile';
                break;
            case 2:
            //邮箱
                if(!preg_match('/\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/',$key)) {
                    return back()->with(['status'=>0,'msg'=>'邮箱格式不对']);
                }
                $where = 'user_email';
                break;
            case 3:
            //用户名
                $where = 'user_name';
                break;
            default:
            //账户id
                $where = 'user_account';
                break;
        }
        //查询是否存在此条记录
        $result = (new User())->select(['user_pwd','user_key'])->where($where,'=',$key)->first();

        if (!$result) {
            return Redirect::to('admin/indexLogin')->with('error', '不存在该用户')->withInput();
        }

        $value = Hash::check($value.config('password_key').$result->user_key,$result->user_pwd);

        if ($value === false) {
            return Redirect::to('admin/indexLogin')->with('error', '密码输入不正确')->withInput();
        }
        if (!Session::has('admin') && !Session::has('admin_key')) {
            Session::put('admin',$key);
            Session::put('admin_id',$result->user_id);
            Session::put('admin_key',$result->user_key);
        }
        return Redirect::to('admin/index')->with('success', '欢迎登录');
    }

    /**
     * Notes:退出登录
     * User: "LiJinGuo"
     * Date: 2018/8/10
     * Time: 16:46
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if (!Session::has('admin') && !Session::has('admin_key') && !Session::has('admin_id')) {
            return back()->with(['status'=>0,'msg'=>'该用户已经退出登录']);
        }
        Session::forget('admin');
        Session::forget('admin_id');
        Session::forget('admin_key');
        return Redirect::to('admin/indexLogin')->with('success', '欢迎登录');
    }

    public function logoImg()
    {
        return view('admin/admin/img');
    }
}
