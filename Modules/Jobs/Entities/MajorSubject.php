<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class MajorSubject extends JobAttribute
{
    protected $table = 'job_attributes_major_subjects';

    protected static function getFieldName()
    {
        return 'major_subject_id';
    }

    protected static function getLabelName()
    {
        return __('Major subject');
    }
}