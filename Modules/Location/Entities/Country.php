<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\CountryDetail;
use Modules\Location\Entities\State;

class Country extends Model
{
    protected $table = 'location_countries';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
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
        $details = $this->detail()->get();
        foreach ($details as $detail) {
            $detail->deleteChain();
        }

        $states = $this->states()->get();
        foreach ($states as $state) {
            $state->deleteChain();
        }

        $this->delete();
    }

    public function detail()
    {
        return $this->hasOne(CountryDetail::class, 'country_id', 'id');
    }

    public function states()
    {
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public static function renderLocationDropdown($names = null, $default_values = null, $labels = null){
        if(!isset($names)) {
            $names = ['country_id', 'state_id', 'city_id'];
        }

        if(!isset($default_values)) {
            $default_values = ['', '', ''];
        }

        if(!isset($labels)) {
            $labels = [__('Country'), __('State'), __('City')];
        }

        $countries = static::active()->get();

        return view('location::location_dropdown', [
            'names' => $names,
            'default_values' => $default_values,
            'labels' => $labels,
            'countries' => $countries
        ]);
    }
}
