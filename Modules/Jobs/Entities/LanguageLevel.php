<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class LanguageLevel extends JobAttribute
{
    protected $table = 'job_attributes_language_levels';

    protected static function getFieldName()
    {
        return 'language_level_id';
    }

    protected static function getLabelName()
    {
        return __('Language level');
    }
}