<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewAny(User $user) {
        return true; // All can view
    }

    public function manage(User $user) {
        return $user->isAdmin(); // Only Admin
    }
}