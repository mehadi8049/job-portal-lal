<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class JobShift extends JobAttribute
{
    protected $table = 'job_attributes_job_shifts';

    protected static function getFieldName()
    {
        return 'job_shift_id';
    }

    protected static function getLabelName()
    {
        return __('Job shift');
    }
}