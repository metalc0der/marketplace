<?php

namespace Metalc0der\Marketplace\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /** @var Setting */
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
            'key' => $this->resource->key,
            'value' => $this->resource->value,
            'owner_id' => $this->resource->seteable_id,
            'owner_type' => $this->resource->seteable_type
        ];
    }
}