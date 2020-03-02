<?php

namespace CodeDelivery\OAuth2;

use Illuminate\Support\Facades\Auth;
use Log;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        Log::info('usuario');
        Log::info($username);
        Log::info('usuario');
        Log::info($password);

        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials))
        {
            return Auth::user()->id;
        }

        return false;
    }
}