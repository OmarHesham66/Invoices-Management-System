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
            return true;
        } else {
            return false;
        }
    }
}
