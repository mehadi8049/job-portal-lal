<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class Gender extends JobAttribute
{
    protected $table = 'job_attributes_genders';

    protected static function getFieldName()
    {
        return 'gender_id';
    }

    protected static function getLabelName()
    {
        return __('Gender');
    }
}