<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class LanguageProficiency extends Model
{
    protected $fillable = [
        'user_id',
        'language_name',
        'reading_level',
        'writing_level',
        'speaking_level'
    ];
}
