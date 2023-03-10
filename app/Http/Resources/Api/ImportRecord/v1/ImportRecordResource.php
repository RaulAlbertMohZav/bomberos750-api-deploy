<?php

namespace App\Http\Resources\Api\ImportRecord\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ImportRecordResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'import-records',
            'id' => $this->resource->getRouteKey(),
            'attributes' => [
                "number_of_row" => $this->resource->number_of_row,
                "has_errors" => $this->resource->has_errors === 'yes',
                "errors_validation" => $this->resource->errors_validation,
                "created_at" => date('Y-m-d H:i:s', strtotime($this->resource->created_at))
            ],
            'relationships' => [

            ]
        ];
    }
}
