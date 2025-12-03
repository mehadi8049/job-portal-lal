<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\OwnershipType;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class OwnershipTypesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return OwnershipType::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('ownership type'),
            'Name' => __('Ownership type'),
            'names' => __('ownership types'),
            'Names' => __('Ownership types'),

            'name.required' => __('Ownership type is required'),

            'title_create' => __('Create Ownership type'),
            'title_edit' => __('Edit Ownership type'),

            'default_item' => __('Default ownership types'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'ownership_types';
    }
}
