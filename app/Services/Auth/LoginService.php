<?php

namespace App\Services\Auth;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;


class LoginService
{
    /**
     * Create a new class instance.
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('loginToken')->plainTextToken;
        return ['user' => $user ,'token'=>$token];
    }
}
