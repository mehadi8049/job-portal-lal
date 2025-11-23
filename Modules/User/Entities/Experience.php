<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'company_business',
        'designation',
        'department',
        'employment_from',
        'employment_to',
        'is_current',
        'responsibilities',
        'area_of_expertise',
        'company_location'
    ];

    protected $dates = [
        'employment_from',
        'employment_to'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'area_of_expertise' => 'array'
    ];
}
