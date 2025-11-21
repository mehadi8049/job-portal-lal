<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id',
        'skill_name',
        'skill_learned_from'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'skill_learned_from' => 'array'
    ];
}
