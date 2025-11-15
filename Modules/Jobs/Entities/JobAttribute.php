<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class JobAttribute extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'is_default',
        'is_active',
        'sort_order',
    ];
   
    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected abstract static function getFieldName();

    protected abstract static function getLabelName();

    public function scopeDefault($query)
    {
        return $query->where('is_default', '=', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public static function renderDropdown($name = null, $default_value = '', $label = null){
        if(!isset($name)) {
            $name = static::getFieldName();
        }

        if(!isset($label)) {
            $label = static::getLabelName();
        }

        $items = static::active()->get();

        return view('jobs::job_attributes.dropdown', [
            'name' => $name,
            'default_value' => $default_value,
            'label' => $label,
            'items' => $items
        ]);
    }
}
