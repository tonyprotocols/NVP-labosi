<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function all()
    {
        return User::all();
    }
}