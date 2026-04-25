<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\LoginService;

class LoginController extends ApiController
{
    public function __construct(protected LoginService $loginService)
    {
        $this->LoginService = $loginService;
    }

    public function store(LoginRequest $request)
    {
        $userLogin = $this->loginService->login($request);

        return $this->success([
            'user' => new LoginResource($userLogin['user']),
            'token' => $userLogin['token'],
        ], 'User Logged in Successfully');
    }
}
