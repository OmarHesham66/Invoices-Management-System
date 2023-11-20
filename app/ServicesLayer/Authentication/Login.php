<?php

namespace App\ServicesLayer\Authentication;

use App\Traits\AttemptLogin\User;
use App\Traits\AttemptLogin\Admin;

class Login
{
    use Admin, User;
    public function login($request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($this->attempt_login_user($request)) {
            return 'user';
        } elseif ($this->attempt_login_admin($request)) {
            return 'admin';
        } else {
            return redirect()->back()->withErrors('The Email Or Password Is Invalid');
        }
    }
}
