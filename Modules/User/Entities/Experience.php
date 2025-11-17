<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [];

    protected $dates = [
        'employment_from',
        'employment_to'
    ];
}
