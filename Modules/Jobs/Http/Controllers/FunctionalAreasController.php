<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\FunctionalArea;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class FunctionalAreasController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return FunctionalArea::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('functional area'),
            'Name' => __('Functional area'),
            'names' => __('functional areas'),
            'Names' => __('Functional areas'),

            'name.required' => __('Functional area is required'),

            'title_create' => __('Create Functional area'),
            'title_edit' => __('Edit Functional area'),

            'default_item' => __('Default functional area'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'functional_areas';
    }
}
