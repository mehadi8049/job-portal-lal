<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\City;

class State extends Model
{
    protected $table = 'location_states';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'country_id',
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
        $cities = $this->cities()->get();
        foreach ($cities as $city) {
            $city->deleteChain();
        }

        $this->delete();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'id');
    }
}
