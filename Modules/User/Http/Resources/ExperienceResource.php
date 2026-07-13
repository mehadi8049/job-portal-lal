<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'company_name'     => $this->company_name,
            'company_business' => $this->company_business,
            'designation'      => $this->designation,
            'department'       => $this->department,
            'employment_from'  => $this->employment_from,
            'employment_to'    => $this->employment_to,
            'is_current'       => (bool) $this->is_current,
            'responsibilities' => $this->responsibilities,
            'area_of_expertise' => $this->area_of_expertise,
            'company_location'  => $this->company_location,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
