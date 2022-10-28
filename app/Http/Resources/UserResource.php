<?php

namespace App\Http\Resources;

use App\Http\Resources\Pivot\CarUserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_active' => $this->whenPivotLoaded('car_user', function () {
                return $this->pivot->is_active;
            }),
            'car' => new CarResource($this->whenLoaded('car')),
            'car_user' => new CarUserResource($this->whenLoaded('carUser'))
        ];
    }
}
