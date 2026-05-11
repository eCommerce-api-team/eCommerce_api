<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Services\Admin\UserService;
use App\Http\Resources\UserResource;

class UserController extends ApiController
{
    public function __construct(protected UserService $userService){
    }
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return $this->success(UserResource::collection($users), 'All users');   
    }
    public function show(int $id)
    {
        $userDetails = $this->userService->getUserDetails($id);

        return $this->success(new UserResource($userDetails), 'User Details');
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $deactivateUser = $this->userService->deactivateUser($id);

        return $this->success(new UserResource($deactivateUser), 'User Deactivate Successfully');
    }
}
