<?php

namespace App\Services\Admin;

use App\Models\User;

class UserService
{
    public function getAllUsers($request = null, int $perPage = 10)
    {
        return $users = User::Filter($request)->paginate($perPage);
    }

    public function getUserDetails(int $id)
    {
        return $user = User::findOrFail($id);
    }

    public function deactivateUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'active_status' => false,
        ]);

        return $user;
    }
}
