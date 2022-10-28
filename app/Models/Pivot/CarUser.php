<?php

namespace App\Models\Pivot;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CarUser extends Pivot
{
    protected $table = 'car_user';

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
