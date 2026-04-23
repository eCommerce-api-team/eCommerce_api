<?php

namespace App\Services\Auth;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterService
{
    /**
     * Create a new class instance.
     */
    public function register(RegisterRequest $request)
    {
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
        ]);
        
        event(new Registered($user));

        return $user;
    }
}
