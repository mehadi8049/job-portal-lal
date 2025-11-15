<?php

namespace Modules\Jobs\Entities;

use Modules\Jobs\Entities\JobAttribute;

class SalaryPeriod extends JobAttribute
{
    protected $table = 'job_attributes_salary_periods';

    protected static function getFieldName()
    {
        return 'salary_period_id';
    }

    protected static function getLabelName()
    {
        return __('Salary period');
    }
}