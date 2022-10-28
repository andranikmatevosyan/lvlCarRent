<?php

namespace Tests\Unit\Repositories;

use App\Models\Car;
use App\Models\User;
use App\Repositories\CarRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CarRepositoryTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * @return Application|CarRepository
     */
    public function getRepository(): CarRepository|Application
    {
        return app(CarRepository::class);
    }

    /**
     * Test rent functionality.
     *
     * @return void
     */
    public function test_rent(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $this->getRepository()->rent($car, $user);

        $this->assertDatabaseHas('car_user', [
            'user_id' => $user->id,
            'car_id' => $car->id,
            'is_active' => true
        ]);

        $this->assertDatabaseCount('car_user', 1);
    }

    /**
     * Test active user exists returns true.
     *
     * @return void
     */
    public function test_active_user_exists(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $car->users()->sync([
            $user->id => ['is_active' => true]
        ], false);

        $response = $this->getRepository()->activeUserExists($car);

        $this->assertTrue($response);
    }

    /**
     * Test active user exists returns false.
     *
     * @return void
     */
    public function test_active_user_does_not_exist(): void
    {
        User::factory()->create();
        $car = Car::factory()->create();

        $response = $this->getRepository()->activeUserExists($car);

        $this->assertFalse($response);
    }
}
