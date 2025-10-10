<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'description' => $this->resource->description,
            'address' => $this->resource->address,
            'date_time' => Carbon::parse($this->resource->date_time)->timestamp,
            'created_at' => Carbon::parse($this->resource->created_at)->timestamp,
            'updated_at' => Carbon::parse($this->resource->updated_at)->timestamp,
            'deleted_at' => $this->when($this->resource->deleted_at, function () {
                return Carbon::parse($this->resource->deleted_at)->timestamp;
            }),
        ];
    }
}
