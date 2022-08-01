<?php

namespace App\Policies;

use App\Models\ContentGroup;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentGroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, ContentGroup $contentGroup)
    {
        return $user->program_id === $contentGroup->program_id;
    }
}
