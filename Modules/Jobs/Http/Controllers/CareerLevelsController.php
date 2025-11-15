<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\CareerLevel;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class CareerLevelsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return CareerLevel::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('career level'),
            'Name' => __('Career level'),
            'names' => __('career levels'),
            'Names' => __('Career levels'),

            'name.required' => __('Career level is required'),

            'title_create' => __('Create Career level'),
            'title_edit' => __('Edit Career level'),

            'default_item' => __('Default career level'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'career_levels';
    }
}
