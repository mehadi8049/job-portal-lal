<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class ResultType extends JobAttribute
{
    protected $table = 'job_attributes_result_types';

    protected static function getFieldName()
    {
        return 'result_type_id';
    }

    protected static function getLabelName()
    {
        return __('Result type');
    }
}