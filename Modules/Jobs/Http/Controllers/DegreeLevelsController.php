<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\DegreeLevel;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class DegreeLevelsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return DegreeLevel::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('degree level'),
            'Name' => __('Degree level'),
            'names' => __('degree levels'),
            'Names' => __('Degree levels'),

            'name.required' => __('Degree level is required'),

            'title_create' => __('Create Degree level'),
            'title_edit' => __('Edit Degree level'),

            'default_item' => __('Default degree level'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'degree_levels';
    }
}
