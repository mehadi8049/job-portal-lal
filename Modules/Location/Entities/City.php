<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\State;

class City extends Model
{
    protected $table = 'location_cities';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'state_id',
        'name',
        'is_default',
        'is_active',
        'sort_order',
    ];
   
    protected $casts = [
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeDefault($query)
    {
        return $query->where('is_default', '=', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function deleteChain()
    {
        $this->delete();
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
