<?php

namespace App\Processors\Car;

use App\Exceptions\CarAlreadyReservedException;
use App\Models\Car;
use App\Models\User;
use App\Repositories\CarRepository;

class CarProcessor
{
    public function __construct(
        private CarRepository $carRepository
    ) {

    }

    /**
     * @param Car $car
     * @param User $user
     * @return mixed
     * @throws CarAlreadyReservedException
     */
    public function processRent(Car $car, User $user): mixed
    {
        if ($this->carRepository->activeUserExists($car)) {
            throw new CarAlreadyReservedException();
        }

        return $this->carRepository->rent($car, $user);
    }
}
