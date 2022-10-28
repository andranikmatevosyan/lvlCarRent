<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait MainTrait
{
    /**
     * Get user or fail
     *
     * @param int $id
     * @return Model|User|Builder
     */
    public function user(int $id): Model|User|Builder
    {
        return User::query()->where('id', '=', $id)->firstOrFail();
    }
}
