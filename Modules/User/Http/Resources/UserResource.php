<?php

namespace Modules\User\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'role'              => $this->role,
            'name'              => $this->name,
            'email'             => $this->email,
            'photo'             => $this->photo ? url('storage/user_storage/' . $this->id . '/' . $this->photo) : null,
            'father_name'       => $this->father_name,
            'mother_name'       => $this->mother_name,
            'date_of_birth'     => $this->date_of_birth,
            'gender'            => $this->gender,
            'religion'          => $this->religion,
            'marital_status'    => $this->marital_status,
            'nationality'       => $this->nationality,
            'national_id'       => $this->national_id,
            'passport_number'   => $this->passport_number,
            'primary_mobile'    => $this->primary_mobile,
            'secondary_mobile'  => $this->secondary_mobile,
            'emergency_contact' => $this->emergency_contact,
            'alternate_email'   => $this->alternate_email,
            'blood_group'       => $this->blood_group,
            'present_address'   => $this->present_address,
            'parmanent_address' => $this->parmanent_address,
            'objective'         => $this->objective,
            'present_salary'    => $this->present_salary,
            'expected_salary'   => $this->expected_salary,
            'job_level'         => $this->job_level,
            'job_nature'        => $this->job_nature,
            'career_summary'    => $this->career_summary,
            'special_qualification' => $this->special_qualification,
            'keywords'          => $this->keywords,
            'email_verified_at' => $this->email_verified_at,
            'experiences'       => ExperienceResource::collection($this->whenLoaded('experiences')),
            'qualifications'    => QualificationResource::collection($this->whenLoaded('qualifications')),
            'skills'            => SkillResource::collection($this->whenLoaded('skills')),
            'preferred_job_categories' => PreferredJobCategoryResource::collection($this->whenLoaded('preferredJobCategories')),
            'language_proficiencies'   => LanguageProficiencyResource::collection($this->whenLoaded('languageProficiencies')),
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
