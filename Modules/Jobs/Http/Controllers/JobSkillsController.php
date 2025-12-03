<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\JobSkill;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class JobSkillsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return JobSkill::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('job skill'),
            'Name' => __('Job skill'),
            'names' => __('job skills'),
            'Names' => __('Job skills'),

            'name.required' => __('Job skill is required'),

            'title_create' => __('Create Job skill'),
            'title_edit' => __('Edit Job skill'),

            'default_item' => __('Default job skills'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'job_skills';
    }
}
