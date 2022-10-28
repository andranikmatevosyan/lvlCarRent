<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserDoesNotHaveActiveCarException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(['message' => 'User does not have active car'], JsonResponse::HTTP_NOT_ACCEPTABLE);
    }
}
