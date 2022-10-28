<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    /**
     * Determine user has active car
     *
     * @param User $user
     * @return bool
     */
    public function activeCarExists(User $user): bool
    {
        return $user->cars()
            ->wherePivot('is_active', '=', true)
            ->exists();
    }

    /**
     * Getting active car
     *
     * @param User $user
     * @return mixed|null
     */
    public function findActiveCar(User $user): mixed
    {
        return $user->cars()
            ->wherePivot('is_active', '=', true)
            ->first();
    }
}
