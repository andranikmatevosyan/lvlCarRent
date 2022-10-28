<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CarAlreadyReservedException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json(['message' => 'Provided car is already reserved'], JsonResponse::HTTP_NOT_ACCEPTABLE);
    }
}
