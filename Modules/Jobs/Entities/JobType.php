<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class JobType extends JobAttribute
{
    protected $table = 'job_attributes_job_types';

    protected static function getFieldName()
    {
        return 'job_type_id';
    }

    protected static function getLabelName()
    {
        return __('Job type');
    }
}