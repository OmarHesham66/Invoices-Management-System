<?php

namespace App\Traits\AttemptLogin;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait User
{
    public function attempt_login_user($request)
    {
        return Auth::attempt($request->except('_token'), $request->post('remember'));
    }
}
