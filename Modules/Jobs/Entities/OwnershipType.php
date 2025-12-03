<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class OwnershipType extends JobAttribute
{
    protected $table = 'job_attributes_ownership_types';

    protected static function getFieldName()
    {
        return 'ownership_type_id';
    }

    protected static function getLabelName()
    {
        return __('Ownership type');
    }
}