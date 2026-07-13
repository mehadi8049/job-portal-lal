<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PreferredJobCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                         => $this->id,
            'functional_area'            => $this->functional_area,
            'special_skills'             => $this->special_skills,
            'preferred_locations_inside'  => $this->preferred_locations_inside,
            'preferred_locations_outside' => $this->preferred_locations_outside,
            'preferred_organization_types' => $this->preferred_organization_types,
            'created_at'                 => $this->created_at,
            'updated_at'                 => $this->updated_at,
        ];
    }
}
