<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Order $order) {
        return $user->isAdmin() || $order->assigned_staff_id === $user->id;
    }

    public function updateStatus(User $user, Order $order) {
        return $user->isAdmin() || $order->assigned_staff_id === $user->id;
    }
}