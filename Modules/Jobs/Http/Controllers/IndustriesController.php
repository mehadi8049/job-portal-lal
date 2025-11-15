<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\Industry;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class IndustriesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return Industry::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('industry'),
            'Name' => __('Industry'),
            'names' => __('industrys'),
            'Names' => __('Industries'),

            'name.required' => __('Industry is required'),

            'title_create' => __('Create Industry'),
            'title_edit' => __('Edit Industry'),

            'default_item' => __('Default industry'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'industries';
    }
}
