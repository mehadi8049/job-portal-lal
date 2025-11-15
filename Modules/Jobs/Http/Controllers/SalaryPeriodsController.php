<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\SalaryPeriod;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class SalaryPeriodsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return SalaryPeriod::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('salary period'),
            'Name' => __('Salary period'),
            'names' => __('salary periods'),
            'Names' => __('Salary periods'),

            'name.required' => __('Salary period is required'),

            'title_create' => __('Create Salary period'),
            'title_edit' => __('Edit Salary period'),

            'default_item' => __('Default salary periods'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'salary_periods';
    }
}
