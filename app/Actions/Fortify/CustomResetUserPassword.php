<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class CustomResetUserPassword implements ResetsUserPasswords
{
    public function reset($user, array $input)
    {
        $user->forceFill([
            'password' => Hash::make($input['password']),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));

        // Auth::login($user);
    }
}
