<?php

namespace App\Policies;

use App\Domain\Link;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
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

    public function destroy(User $user, Link $link): bool
    {
        if($user->id == null) return false;
        return $user->id == $link->getOwnerId();
    }

    public function edit(User $user, Link $link): bool
    {
        if($user->id == null) return false;
        return $user->id == $link->getOwnerId();
    }

    public function update(User $user, Link $link): bool
    {
        if($user->id == null) return false;
        return $user->id == $link->getOwnerId();
    }
}
