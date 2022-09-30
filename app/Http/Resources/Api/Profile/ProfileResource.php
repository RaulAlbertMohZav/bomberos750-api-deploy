<?php

namespace App\Http\Resources\Api\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'profile',
            'id' => $this->resource->getRouteKey(),
            'attributes' => [
                "identification_number" => $this->resource->identification_number,
                'name' => $this->resource->name,
                'last_name' => $this->resource->last_name,
                'email' => $this->resource->email,
                'number_phone' => $this->resource->number_phone,
                "last_session" => ($this->resource->last_session !== null) ? $this->resource->last_session->format('Y-m-d h:m:s') : null ,
                "created_at" => $this->resource->created_at->format('Y-m-d h:m:s'),
            ]
        ];
    }
}
