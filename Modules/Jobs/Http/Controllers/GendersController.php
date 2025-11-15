<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\Gender;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class GendersController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return Gender::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('gender'),
            'Name' => __('Gender'),
            'names' => __('genders'),
            'Names' => __('Genders'),

            'name.required' => __('Gender is required'),

            'title_create' => __('Create Gender'),
            'title_edit' => __('Edit Gender'),

            'default_item' => __('Default gender'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'genders';
    }
}
