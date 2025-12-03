<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class JobExperience extends JobAttribute
{
    protected $table = 'job_attributes_job_experiences';

    protected static function getFieldName()
    {
        return 'job_experience_id';
    }

    protected static function getLabelName()
    {
        return __('Job experience');
    }
}