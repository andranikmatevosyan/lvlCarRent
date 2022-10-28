<?php

namespace App\Http\Controllers\User;

use App\Exceptions\UserDoesNotHaveActiveCarException;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\User;
use App\Processors\User\UserProcessor;
use Illuminate\Http\JsonResponse;

class UserDriveController extends Controller
{
    /**
     * @param UserProcessor $processor
     * @param User $user
     * @return JsonResponse
     * @throws UserDoesNotHaveActiveCarException
     */
    public function __invoke(
        UserProcessor $processor,
        User $user
    ): JsonResponse {
        $response = $processor->processDrive( $user);

        return response()->json(new CarResource($response), 200);
    }
}
