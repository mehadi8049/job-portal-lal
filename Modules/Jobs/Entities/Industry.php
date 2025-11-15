<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class Industry extends JobAttribute
{
    protected $table = 'job_attributes_industries';

    protected static function getFieldName()
    {
        return 'industry_id';
    }

    protected static function getLabelName()
    {
        return __('Industry');
    }
}