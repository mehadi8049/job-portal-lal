<?php

namespace Modules\Jobs\Http\Controllers;

use Modules\Jobs\Entities\LanguageLevel;
use Modules\Jobs\Http\Controllers\JobAttributesController;

class LanguageLevelsController extends JobAttributesController
{
    protected function getmodel_class() 
    {
        return LanguageLevel::class;
    }

    protected function getTranslates()
    {
        return [
            'name' => __('language level'),
            'Name' => __('Language level'),
            'names' => __('language levels'),
            'Names' => __('Language levels'),

            'name.required' => __('Language level is required'),

            'title_create' => __('Create Language level'),
            'title_edit' => __('Edit Language level'),

            'default_item' => __('Default language level'),
        ];
    }

    protected function getAttrRoute() 
    {
        return 'language_levels';
    }
}
