<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }
    
    public function checkTaskOwner(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    } 

    public function checkIsMember(User $user, Task $task)
    {
        // Check if user's name exists in the long string column
        return strpos($task->members, $user->name) !== false;
    } 
    
}
