<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\JobShift;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class JobShiftsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return JobShift::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('job shift'),
            'Name' => __('Job shift'),
            'names' => __('job shifts'),
            'Names' => __('Job shifts'),

            'name.required' => __('Job shift is required'),

            'title_create' => __('Create Job shift'),
            'title_edit' => __('Edit Job shift'),

            'default_item' => __('Default job shift'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'job_shifts';
    }
}
