<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function getUser()
    {
        return ['username'=>$this->username,'email'=>$this->emial];
    }

}
