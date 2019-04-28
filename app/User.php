<?php

namespace App;

use App\Models\DataModels\UserDetailsModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone', 'email', 'password','username','validate_token', 'is_validate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*public function sendValidateMail()
    {
        return Mail::to($this->email)->send(new MailConfirm($this));
    }*/

    public function geValidateMailLink(){
        $params = [
            'user_id' => $this->id,
            'validate_token' => $this->validate_token,
        ];
        return route('confirm',$params);
    }

    /**
     *  验证邮件地址
     * @return string
     */
    public function getSendConfirmMailLink(){
        return route('send-confirm-mail');
    }

    public function createUser(array $userArr, array $detailArr)
    {
        DB::beginTransaction();
        try {
            $gitId = $this->insertGetId($userArr);

            if ($gitId < 1) {
                $error = '写入得到用户表ID失败';
                throw new \Exception($error);
            }

            $result = $detailArr['user_id'] = $gitId;

            UserDetailsModel::create($detailArr);

            DB::commit();
        } catch(\Exception $e) {
            \Log::error('用户详细信息写入失败:'.$e->getMessage());
            $result = false;
            DB::rollback();
        }

        return $result;
    }

    public function getUserEmail(String $email)
    {
        $result = $this::where('email','=',$email)->first();

        return $result;
    }

}
