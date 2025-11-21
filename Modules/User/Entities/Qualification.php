<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'user_id',
        'education_level',
        'degree_title',
        'major',
        'institute_name',
        'result_type',
        'cgpa',
        'scale',
        'passing_year',
        'duration_years',
        'achievement'
    ];
}
