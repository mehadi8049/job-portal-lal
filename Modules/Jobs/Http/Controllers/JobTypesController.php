<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\JobType;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class JobTypesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return JobType::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('job type'),
            'Name' => __('Job type'),
            'names' => __('job types'),
            'Names' => __('Job types'),

            'name.required' => __('Job type is required'),

            'title_create' => __('Create Job type'),
            'title_edit' => __('Edit Job type'),

            'default_item' => __('Default job types'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'job_types';
    }
}
