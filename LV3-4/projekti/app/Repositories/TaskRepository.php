<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Task;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Task::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function forMember($userName)
    {
        return Task::whereRaw("FIND_IN_SET(?, members)", [$userName])->get();
    }
}
