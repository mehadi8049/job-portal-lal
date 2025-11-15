<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\MaritalStatus;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class MaritalStatusesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return MaritalStatus::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('marital status'),
            'Name' => __('Marital status'),
            'names' => __('marital statuses'),
            'Names' => __('Marital statuses'),

            'name.required' => __('Marital status is required'),

            'title_create' => __('Create Marital status'),
            'title_edit' => __('Edit Marital status'),

            'default_item' => __('Default marital statuses'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'marital_statuses';
    }
}
