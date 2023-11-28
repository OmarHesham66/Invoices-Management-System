<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Controllers\Controller;
use App\Traits\ResponseApi\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Rules\CheckCodeNotExpireAndCorrect;
use App\ServicesLayer\Authentication\Login;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use Response;
    public function login(Request $request, Login $login)
    {
        $check = $login->login($request);
        if ($check) {
            return $this->sendResponse('data', [
                'user' => auth()->user(),
                'token' => auth()->user()->createToken($request->userAgent())->plainTextToken
            ], 'success', 200);
        } else {
            return $this->sendResponse(
                'message',
                'The Email Or Password Is Invalid',
                'Error',
                401
            );
        }
    }
    public function post_verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'max:4', 'min:4', new CheckCodeNotExpireAndCorrect()]
        ]);
        if ($validator->fails()) {
            return $this->sendResponse('errors', $validator->errors()->toArray(), 'Error', 401);
        }
        User::find(auth()->id())->VerifyDone();
        return $this->sendResponse('message', 'Success Verification, Welcome', 'success', 200);
    }
    public function resend_code()
    {
        $user = User::find(auth()->id())->GenerateCode();
        Mail::to($user->email)->queue(new VerificationMail($user));
        return $this->sendResponse('message', 'done', 'success', 200);
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->sendResponse('message', 'Logout Successfuly ', 'success', 200);
    }
}
