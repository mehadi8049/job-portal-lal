<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class JobSkill extends JobAttribute
{
    protected $table = 'job_attributes_job_skills';

    protected static function getFieldName()
    {
        return 'job_skill_id';
    }

    protected static function getLabelName()
    {
        return __('Job skill');
    }
}