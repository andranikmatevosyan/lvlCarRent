<?php

namespace App\Models;

use App\Models\Pivot\CarUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'vin'
    ];

    /**
     * Getting all users of the car
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(CarUser::class)
            ->withPivot('is_active')
            ->withTimestamps();
    }

    /**
     * @return HasOneThrough
     */
    public function user(): HasOneThrough
    {
        return $this
            ->hasOneThrough(User::class, CarUser::class, 'car_id', 'id', 'id', 'user_id')
            ->where('is_active', true);
    }

    /**
     * @return HasOne
     */
    public function carUser(): HasOne
    {
        return $this->hasOne(CarUser::class);
    }
}
