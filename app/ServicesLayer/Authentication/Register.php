<?php

namespace App\ServicesLayer\Authentication;

use App\Events\ActiveCode;
use App\Models\User;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class Register
{
    public function register($request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => "required|email|unique:users,email",
            'password' => 'required|min:8|max:20|confirmed',
            'role' => 'required|array',
        ]);
        $request['photo'] = 'Images_profile/Profile.png';
        $user = User::create($request->except('role'));
        return $user;
    }
}
