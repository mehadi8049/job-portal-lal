<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'company_id'        => $this->company_id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'responbilities'    => $this->responbilities,
            'requirements'      => $this->requirements,
            'benefits'          => $this->benefits,
            'country_id'        => $this->country_id,
            'state_id'          => $this->state_id,
            'city_id'           => $this->city_id,
            'is_freelance'      => (bool) $this->is_freelance,
            'career_level_id'   => $this->career_level_id,
            'salary_from'       => $this->salary_from,
            'salary_to'         => $this->salary_to,
            'hide_salary'       => (bool) $this->hide_salary,
            'salary_currency'   => $this->salary_currency,
            'salary_period_id'  => $this->salary_period_id,
            'functional_area_id' => $this->functional_area_id,
            'job_type_id'       => $this->job_type_id,
            'job_shift_id'      => $this->job_shift_id,
            'num_of_positions'  => $this->num_of_positions,
            'gender_id'         => $this->gender_id,
            'expiry_date'       => $this->expiry_date,
            'degree_level_id'   => $this->degree_level_id,
            'job_experience_id' => $this->job_experience_id,
            'is_active'         => (bool) $this->is_active,
            'is_featured'       => (bool) $this->is_featured,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'company'           => new CompanyResource($this->whenLoaded('company')),
            'city'              => $this->whenLoaded('city', function () {
                return ['id' => $this->city->id, 'name' => $this->city->name];
            }),
            'job_type'          => $this->whenLoaded('job_type', function () {
                return ['id' => $this->job_type->id, 'name' => $this->job_type->name];
            }),
            'functional_area'   => $this->whenLoaded('functional_area', function () {
                return ['id' => $this->functional_area->id, 'name' => $this->functional_area->name];
            }),
            'job_experience'    => $this->whenLoaded('job_experience', function () {
                return ['id' => $this->job_experience->id, 'name' => $this->job_experience->name];
            }),
            'gender'            => $this->whenLoaded('gender', function () {
                return ['id' => $this->gender->id, 'name' => $this->gender->name];
            }),
            'degree_level'      => $this->whenLoaded('degree_level', function () {
                return ['id' => $this->degree_level->id, 'name' => $this->degree_level->name];
            }),
        ];
    }
}
