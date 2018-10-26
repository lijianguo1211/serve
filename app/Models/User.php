<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class User extends Model
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username', 'email', 'password','account','mobile','token','QQ','github'
    ];

}
