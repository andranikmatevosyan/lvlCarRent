<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\User;

class CarRepository
{
    /**
     * Rent a car for user
     *
     * @param Car $car
     * @param User $user
     * @return mixed
     */
    public function rent(Car $car, User $user): mixed
    {
        $user->cars()
            ->newPivotStatement()
            ->where('user_id', '=', $user->id)
            ->update(['is_active' => false]);

        $car->users()
            ->sync([
                $user->id => ['is_active' => true]
            ], false);

        return $this->loadActiveUser($car);
    }

    /**
     * Getting only active user
     *
     * @param Car $car
     * @param User $user
     * @return mixed|null
     */
    public function findActiveUser(Car $car, User $user): mixed
    {
        return $car->users()
            ->wherePivot('is_active', '=', true)
            ->wherePivot('user_id', '=', $user->id)
            ->first();
    }

    /**
     * @param Car $car
     * @return Car
     */
    public function loadActiveUser(Car $car): Car
    {
        $car->load(['user', 'carUser']);

        return $car;
    }

    /**
     * Determine if car has active user
     *
     * @param Car $car
     * @return bool
     */
    public function activeUserExists(Car $car): bool
    {
        return $car->users()
            ->wherePivot('is_active', '=', true)
            ->exists();
    }
}
