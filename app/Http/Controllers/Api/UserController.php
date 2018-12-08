<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {

    }

    public function logout(Request $request)
    {

    }

    public function refresh(Request $request)
    {

    }

    public function me(Request $request)
    {

    }
}
