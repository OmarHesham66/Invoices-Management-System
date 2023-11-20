<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckCodeNotExpireAndCorrect implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user =  User::find(auth()->id());
        if ($value != $user->verifiy_code) {
            $fail('The Code is Invalid');
        }
        if ($user->code_expire_at < now()) {
            $fail('The Code is Expire, make another code');
        }
    }
}
