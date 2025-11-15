<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Company extends Model
{
    protected $table = 'companies';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        "user_id",
        "logo",
        "company_name",
        "company_email",
        "company_ceo",
        "industry_id",
        "ownership_type_id",
        "description",
        "location",
        "website",
        "no_of_offices",
        "no_of_employees",
        "established_in",
        "fax",
        "phone",
        "country_id",
        "state_id",
        "city_id",
        "slug",
        "facebook",
        "twitter",
        "linkedin",
        "pinterest",
        "youtube",
        "map",
        "is_active",
        "is_featured",
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', '=', 1);
    }

    public function jobs()
    {
        return $this->hasMany('Modules\Jobs\Entities\Job');
    }

    public function user()
    {
        return $this->belongsTo('Modules\User\Entities\User','user_id');
    }
    public function industry()
    {
        return $this->belongsTo('Modules\Jobs\Entities\Industry','industry_id');
    }
    public function city()
    {
        return $this->belongsTo('Modules\Location\Entities\City','city_id');
    }

    public function getLogoLink() {
        return \URL::to('/') . '/storage/user_storage/' . $this->user_id . '/' . $this->logo;
    }
    public static function boot() {
        parent::boot();
        static::deleting(function($company) {
            $company->jobs()->delete();
       });
    }
}
