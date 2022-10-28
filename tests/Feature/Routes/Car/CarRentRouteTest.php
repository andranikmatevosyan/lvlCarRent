<?php

namespace Tests\Feature\Routes\Car;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class CarRentRouteTest extends TestCase
{
    use RefreshDatabase;

    protected string $route = 'car.rent';

    /**
     * Test route successful response.
     *
     * @return void
     */
    public function test_successful_response(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->postJson(route($this->route, ['car' => $car->id]), [
            'user_id' => $user->id
        ]);

        $response->assertCreated();
    }

    /**
     * Test route exception response.
     *
     * @return void
     */
    public function test_car_already_reserved_exception()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $car->users()->sync([
            $user->id => ['is_active' => true]
        ], false);

        $response = $this->postJson(route($this->route, ['car' => $car->id]), [
            'user_id' => $user->id
        ]);

        $response->assertStatus(JsonResponse::HTTP_NOT_ACCEPTABLE);
    }
}
