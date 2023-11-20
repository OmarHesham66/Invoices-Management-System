<?php

namespace App\Traits\AttemptLogin;

use App\Models\Admin as AdminModel;
use Illuminate\Support\Facades\Auth;

trait Admin
{
    public function attempt_login_admin($request)
    {

        return Auth::guard('admin')->attempt($request->except('_token'), $request->post('remember'));
    }
}
