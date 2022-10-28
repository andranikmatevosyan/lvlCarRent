<?php

namespace Tests\Feature\Routes\User;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class UserDriveRouteTest extends TestCase
{
    use RefreshDatabase;

    protected string $route = 'user.drive';

    /**
     * Test route successful response.
     *
     * @return void
     */
    public function test_successful_response(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $car->users()->sync([
            $user->id => ['is_active' => true]
        ], false);

        $response = $this->getJson(route($this->route, ['user' => $user->id]));

        $response->assertOk();
    }

    /**
     * Test route exception response.
     *
     * @return void
     */
    public function test_user_does_not_have_active_car_exception(): void
    {
        $user = User::factory()->create();
        Car::factory()->create();

        $response = $this->getJson(route($this->route, ['user' => $user->id]));

        $response->assertStatus(JsonResponse::HTTP_NOT_ACCEPTABLE);
    }
}
