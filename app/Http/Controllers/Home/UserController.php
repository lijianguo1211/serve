<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataModels\UserModel;

class UserController extends Controller
{
    public function index()
    {
        echo "<pre>";
        print_r(UserModel::class);
        echo "</pre>";
        /*返回类名 App\Models\DataModels\UserModel*/
    }
}
