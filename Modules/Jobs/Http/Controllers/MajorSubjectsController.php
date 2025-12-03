<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\MajorSubject;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class MajorSubjectsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return MajorSubject::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('major subject'),
            'Name' => __('Major subject'),
            'names' => __('major subjects'),
            'Names' => __('Major subjects'),

            'name.required' => __('Major subject is required'),

            'title_create' => __('Create Major subject'),
            'title_edit' => __('Edit Major subject'),

            'default_item' => __('Default major subjects'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'major_subjects';
    }
}
