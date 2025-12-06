<?php

namespace Modules\QuickLink\Entities;

use Illuminate\Database\Eloquent\Model;

class QuickLink extends Model
{
    protected $fillable = [
        'title',
        'link_url',
        'serial',
        'is_active',
    ];
}
