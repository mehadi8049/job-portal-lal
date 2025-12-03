<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class CareerLevel extends JobAttribute
{
    protected $table = 'job_attributes_career_levels';

    protected static function getFieldName()
    {
        return 'career_level_id';
    }

    protected static function getLabelName()
    {
        return __('Career level');
    }
}