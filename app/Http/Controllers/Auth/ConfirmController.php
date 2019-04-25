<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2019-01-09
 * Time: 10:54
 */

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConfirmController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirm()
    {
        $validate_token = request()->get('validate_token');
        $user_id = request()->get('user_id');
        $user = User::find($user_id);
        if($user->validate_token == $validate_token){
            $user->is_validate = 1;
            $user->validate_token = str_random(24);
            $user->save();
            return redirect('/')->with('status', '验证成功！');
        }else{
            return redirect('/')->with('error', '验证失败！');
        }
    }

    /**
     * 重新发送邮件
     * @return mixed
     */
    public function sendMail()
    {
        Auth::user()->sendValidateMail();
        return redirect('/')->with([
            'status' => '重新发送成功，请到邮箱查收！',
            'confirm' => 1,
        ]);
    }

}