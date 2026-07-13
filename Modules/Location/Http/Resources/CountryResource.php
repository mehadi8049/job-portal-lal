<?php

namespace Modules\Location\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'is_default'  => (bool) $this->is_default,
            'is_active'   => (bool) $this->is_active,
            'sort_order'  => $this->sort_order,
        ];
    }
}
