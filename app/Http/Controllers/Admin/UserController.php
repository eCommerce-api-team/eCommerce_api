<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Admin\UserService;

class UserController extends ApiController
{
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAllUsers();

        return $this->success(UserResource::collection($users), 'All users');
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserDetails($id);

        $this->authorize('view', $user);

        return $this->success(new UserResource($user), 'User Details');
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userService->deactivateUser($id);

        $this->authorize('update', $user);

        return $this->success(new UserResource($user), 'User Deactivate Successfully');
    }
}
