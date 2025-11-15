<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class DegreeLevel extends JobAttribute
{
    protected $table = 'job_attributes_degree_levels';

    protected static function getFieldName()
    {
        return 'degree_level_id';
    }

    protected static function getLabelName()
    {
        return __('Degree level');
    }
    
    public function degreeTypes()
    {
        return $this->hasMany(DegreeType::class, 'degree_level_id', 'id');
    }
}