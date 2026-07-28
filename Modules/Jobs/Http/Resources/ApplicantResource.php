<?php

namespace Modules\Jobs\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'job_id'      => $this->job_id,
            'fullname'    => $this->fullname,
            'email'       => $this->email,
            'description' => $this->description,
            'resume_link' => $this->resume_link,
            'resume_pdf'  => $this->resume_pdf
                ? url('storage/resume_cvs_apply/' . $this->resume_pdf)
                : null,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'job'         => $this->whenLoaded('job', function () {
                return [
                    'id'    => $this->job->id,
                    'title' => $this->job->title,
                    'slug'  => $this->job->slug,
                ];
            }),
        ];
    }
}
