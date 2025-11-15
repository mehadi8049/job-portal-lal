<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\JobExperience;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class JobExperiencesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return JobExperience::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('job experience'),
            'Name' => __('Job experience'),
            'names' => __('job experiences'),
            'Names' => __('Job experiences'),

            'name.required' => __('Job experience is required'),

            'title_create' => __('Create Job experience'),
            'title_edit' => __('Edit Job experience'),

            'default_item' => __('Default job experience'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'job_experiences';
    }
}
