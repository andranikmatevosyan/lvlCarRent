<?php

namespace Tests\Unit\Repositories;

use App\Models\Car;
use App\Models\User;
use App\Repositories\CarRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * @return Application|UserRepository
     */
    public function getRepository(): UserRepository|Application
    {
        return app(UserRepository::class);
    }

    /**
     * Test active user exists returns true.
     *
     * @return void
     */
    public function test_active_car_exists(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $car->users()->sync([
            $user->id => ['is_active' => true]
        ], false);

        $response = $this->getRepository()->activeCarExists($user);

        $this->assertTrue($response);
    }

    /**
     * Test active user exists returns false.
     *
     * @return void
     */
    public function test_active_user_does_not_exist(): void
    {
        $user = User::factory()->create();
        $car = Car::factory()->create();

        $car->users()->sync([
            $user->id => ['is_active' => false]
        ], false);


        $response = $this->getRepository()->activeCarExists($user);

        $this->assertFalse($response);
    }
}
