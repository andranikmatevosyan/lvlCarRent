<?php

namespace App\Http\Resources;

use App\Http\Resources\Pivot\CarUserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'vin' => $this->vin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_active' => $this->whenPivotLoaded('car_user', function () {
                return $this->pivot->is_active;
            }),
            'user' => new UserResource($this->whenLoaded('user')),
            'car_user' => new CarUserResource($this->whenLoaded('carUser'))
        ];
    }
}
