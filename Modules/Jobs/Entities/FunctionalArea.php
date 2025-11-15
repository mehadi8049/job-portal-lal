<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class FunctionalArea extends JobAttribute
{
    protected $table = 'job_attributes_functional_areas';

    protected static function getFieldName()
    {
        return 'functional_area_id';
    }

    protected static function getLabelName()
    {
        return __('Functional area');
    }
}