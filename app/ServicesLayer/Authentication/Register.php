<?php

namespace App\ServicesLayer\Authentication;

use App\Models\User;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Register
{
    public function register($request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => "required|email|unique:users,email",
            'password' => 'required|min:8|max:20|confirmed',
        ]);
        $request['photo'] = 'Images_profile/Profile.png';
        $user = User::create($request->all());
        $user->GenerateCode();
        Mail::to($user->email)->send(new VerificationMail($user));
        Auth::login($user);
    }
}
