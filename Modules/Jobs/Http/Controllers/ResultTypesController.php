<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\ResultType;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class ResultTypesController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return ResultType::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('result type'),
            'Name' => __('Result type'),
            'names' => __('result types'),
            'Names' => __('Result types'),

            'name.required' => __('Result type is required'),

            'title_create' => __('Create Result type'),
            'title_edit' => __('Edit Result type'),

            'default_item' => __('Default result types'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'result_types';
    }
}
