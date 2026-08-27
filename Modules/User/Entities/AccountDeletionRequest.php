<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class AccountDeletionRequest extends Model
{
    protected $table = 'account_deletion_requests';

    protected $fillable = [
        'email',
        'phone',
        'status',
        'reason',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
