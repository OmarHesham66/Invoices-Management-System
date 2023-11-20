<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Rules\CheckCodeNotExpireAndCorrect;
use App\ServicesLayer\Authentication\Login;
use App\ServicesLayer\Authentication\Register;

class AuthController extends Controller
{
    public function index_login()
    {
        return view('Auth.login');
    }
    public function index_register()
    {
        return view('Auth.register');
    }
    public function login(Request $request, Login $login)
    {
        $check = $login->login($request);
        if ($check === 'user') {
            return redirect()->route('panal.index');
        } elseif ($check === 'admin') {
            return redirect()->route('panal.index');
        } else {
            return redirect()->back()->withErrors('The Email Or Password Is Invalid', 'login');
        }
    }
    public function register(Register $register, Request $request)
    {
        $register->register($request);
        return redirect()->route('auth.get_verify');
    }
    public function get_verify()
    {
        return view('Auth.verify');
    }
    public function post_verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:4', 'min:4', new CheckCodeNotExpireAndCorrect()]
        ]);
        User::find(auth()->id())->VerifyDone();
        session()->flash('success.ver', 'Success Verification, Welcome');
        return redirect()->route('panal.index');
    }
    public function resend_code()
    {
        $user = User::find(auth()->id())->GenerateCode();
        Mail::to($user->email)->send(new VerificationMail($user));
        return response()->json([
            'message' => 'done'
        ], 200);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.index.login');
    }
}
