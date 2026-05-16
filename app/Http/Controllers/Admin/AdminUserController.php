<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Admin\UserService;

class AdminUserController extends ApiController
{
    public function __construct(protected UserService $userService) {}

    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = $this->userService->getAllUsers();

        return $this->success(UserResource::collection($users), 'All users');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        $user = $this->userService->getUserDetails($user->id);

        return $this->success(new UserResource($user), 'User Details');
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $user = $this->userService->deactivateUser($user->id);

        return $this->success(new UserResource($user), 'User Deactivate Successfully');
    }
}
