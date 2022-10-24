<?php

namespace App\Http\Resources\Api\Role;


use App\Http\Resources\Api\Permission\PermissionCollection;
use App\Http\Resources\Api\User\UserCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            "type" => "roles",
            "id" => (string) $this->resource->getRouteKey(),
            "attributes" => [
                "roleName" => $this->resource->name,
                "roleAliasName" => $this->resource->alias_name ?: $this->resource->name,
                "createdAt" => $this->resource->created_at->format('Y-m-d h:m:s'),
            ],
            'relationships' => [
                'permissions' => $this->when(collect($this->resource)->has('permissions'),
                    function () {
                        return PermissionCollection::make($this->resource->permissions);
                    }),
                'users' => $this->when(collect($this->resource)->has('users'),
                    function () {
                        return UserCollection::make($this->resource->users);
                    }),
            ],
        ];
    }
}
