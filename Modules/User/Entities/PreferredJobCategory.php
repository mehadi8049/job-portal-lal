<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class PreferredJobCategory extends Model
{
    protected $fillable = [
        'user_id',
        'functional_area',
        'special_skills',
        'preferred_locations_inside',
        'preferred_locations_outside',
        'preferred_organization_types'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'preferred_locations_inside' => 'array',
        'preferred_locations_outside' => 'array',
        'preferred_organization_types' => 'array',
    ];
}
