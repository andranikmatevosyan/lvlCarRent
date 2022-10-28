<?php

namespace App\Processors\User;

use App\Exceptions\UserDoesNotHaveActiveCarException;
use App\Models\User;
use App\Repositories\UserRepository;

class UserProcessor
{
    public function __construct(
        private UserRepository $userRepository
    ) {

    }


    /**
     * Processing drive request
     *
     * @param User $user
     * @return mixed|null
     * @throws UserDoesNotHaveActiveCarException
     */
    public function processDrive(User $user): mixed
    {
        if (!$this->userRepository->activeCarExists($user)) {
            throw new UserDoesNotHaveActiveCarException();
        }

        return $this->userRepository->findActiveCar($user);
    }
}
