<?php

namespace App\Http\Controllers\Car;

use App\Exceptions\CarAlreadyReservedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Car\CarRentRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Processors\Car\CarProcessor;
use Illuminate\Http\JsonResponse;

class CarRentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CarRentRequest $request
     * @param CarProcessor $processor
     * @param Car $car
     * @return JsonResponse
     * @throws CarAlreadyReservedException
     */
    public function __invoke(
        CarRentRequest $request,
        CarProcessor $processor,
        Car $car
    ): JsonResponse {
        $response = $processor->processRent($car, $this->user($request->get('user_id')));

        return response()->json(new CarResource($response), 201);
    }
}
