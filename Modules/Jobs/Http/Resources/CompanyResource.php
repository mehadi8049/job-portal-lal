<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'user_id'          => $this->user_id,
            'company_name'     => $this->company_name,
            'company_email'    => $this->company_email,
            'company_ceo'      => $this->company_ceo,
            'slug'             => $this->slug,
            'industry_id'      => $this->industry_id,
            'ownership_type_id' => $this->ownership_type_id,
            'description'      => $this->description,
            'location'         => $this->location,
            'website'          => $this->website,
            'no_of_offices'    => $this->no_of_offices,
            'no_of_employees'  => $this->no_of_employees,
            'established_in'   => $this->established_in,
            'fax'              => $this->fax,
            'phone'            => $this->phone,
            'country_id'       => $this->country_id,
            'state_id'         => $this->state_id,
            'city_id'          => $this->city_id,
            'logo'             => $this->logo ? url('storage/user_storage/' . $this->user_id . '/' . $this->logo) : null,
            'facebook'         => $this->facebook,
            'twitter'          => $this->twitter,
            'linkedin'         => $this->linkedin,
            'is_active'        => (bool) $this->is_active,
            'is_featured'      => (bool) $this->is_featured,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
            'jobs_count'       => $this->when($this->jobs_count !== null, $this->jobs_count),
            'industry'         => $this->whenLoaded('industry', function () {
                return ['id' => $this->industry->id, 'name' => $this->industry->name];
            }),
            'city'             => $this->whenLoaded('city', function () {
                return ['id' => $this->city->id, 'name' => $this->city->name];
            }),
        ];
    }
}
