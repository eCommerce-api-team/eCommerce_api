<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Traits\AdminByPass;

class OrderPolicy
{
    use AdminByPass;

    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $targetUser): bool
    {
        return $user->id === $targetUser || $user->isAdmin();
    }

    public function update(User $user, Order $order): bool
    {
        return $user->isAdmin();
    }
}
