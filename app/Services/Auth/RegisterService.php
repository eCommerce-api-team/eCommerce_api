<?php

namespace App\Services\Auth;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    /**
     * Create a new class instance.
     */
    public function register(RegisterRequest $request)
    {
       return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
        ]);
    }
}
