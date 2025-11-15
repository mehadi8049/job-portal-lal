<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class MaritalStatus extends JobAttribute
{
    protected $table = 'job_attributes_marital_statuses';

    protected static function getFieldName()
    {
        return 'marital_status_id';
    }

    protected static function getLabelName()
    {
        return __('Martial status');
    }
}