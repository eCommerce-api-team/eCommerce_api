<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Services\Auth\RegisterService;

class RegisterController extends ApiController
{
    public function __construct(protected RegisterService $registerService)
    {
        $this->RegisterService = $registerService;
    }
    public function store(RegisterRequest $request)
    {
        $userRegister = $this->registerService->register($request);

      return $this->success(new RegisterResource($userRegister), 'User Registering Successfully');
    }
}
