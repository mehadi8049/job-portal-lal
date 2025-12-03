<?php

namespace Modules\Location\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Location\Entities\Country;

class CountryDetail extends Model
{
    protected $table = 'location_country_details';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'country_id',
        'sort_name',
        'phone_code',
        'currency',
        'code',
        'symbol',
        'thousand_separator',
        'decimal_separator',
    ];

    public function deleteChain()
    {
        $this->delete();
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
