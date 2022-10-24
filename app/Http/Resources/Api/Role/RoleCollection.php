<?php

namespace App\Http\Resources\Api\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    public $collects = RoleResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
