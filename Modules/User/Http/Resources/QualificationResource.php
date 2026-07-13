<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QualificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'              => $this->id,
            'education_level' => $this->education_level,
            'degree_title'    => $this->degree_title,
            'major'           => $this->major,
            'institute_name'  => $this->institute_name,
            'result_type'     => $this->result_type,
            'cgpa'            => $this->cgpa,
            'scale'           => $this->scale,
            'passing_year'    => $this->passing_year,
            'duration_years'  => $this->duration_years,
            'achievement'     => $this->achievement,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}
