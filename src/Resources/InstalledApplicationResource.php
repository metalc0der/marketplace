<?php

namespace Metalc0der\Marketplace\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InstalledApplicationResource extends JsonResource
{
    /** @var InstalledApplication */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'application_id' => $this->resource->application_id,
            'active' => $this->resource->active,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at
        ];
    }
}