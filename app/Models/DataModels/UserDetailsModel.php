<?php
/**
 * Created by PhpStorm.
 * User: liyi
 * Date: 2019/4/28
 * Time: 9:37
 */

namespace App\Models\DataModels;

use Illuminate\Database\Eloquent\Model;

class UserDetailsModel extends Model
{
    protected $table = "user_details";

    protected $primaryKey = 'id';

    protected $fillable = ['user_id','nick_name','type','avatar','provider'];

    public $timestamps = false;
}
