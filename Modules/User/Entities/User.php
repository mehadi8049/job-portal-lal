<?php

namespace Modules\User\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Notifications\QueuedResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = [
        'email_verified_at',
        'package_ends_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'gender',
        'religion',
        'marital_status',
        'nationality',
        'national_id',
        'passport_number',
        'passport_issue_date',
        'primary_mobile',
        'secondary_mobile',
        'emergency_contact',
        'email',
        'alternate_email',
        'blood_group',
        'height_meters',
        'weight_kg',
        'email_verified_at',
        'password',
        'package_id',
        'package_ends_at',
        'settings',
        'present_address',
        'parmanent_address',
        'objective',
        'present_salary',
        'expected_salary',
        'job_level',
        'job_nature',
        'career_summary',
        'special_qualification',
        'keywords'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'settings' => 'array',
        'keywords' => 'array'
    ];
    
    public function scopeEmployer($query)
    {
        return $query->where('role', '=', 'employer');
    }

    public function scopeCandidate($query)
    {
        return $query->where('role', '=', 'candidate');
    }

    public function resumecvs()
    {
        return $this->hasMany('Modules\ResumeCV\Entities\Resumecv');
    }

    public function experiences()
    {
        return $this->hasMany('Modules\User\Entities\Experience');
    }
    public function qualifications()
    {
        return $this->hasMany('Modules\User\Entities\Qualification');
    }
    
    public function skills()
    {
        return $this->hasMany('Modules\User\Entities\Skill');
    }
    public function preferredJobCategories()
    {
        return $this->hasMany('Modules\User\Entities\PreferredJobCategory');
    }
    public function languageProficiencies()
    {
        return $this->hasMany('Modules\User\Entities\LanguageProficiency');
    }
    
    public function payments()
    {
        return $this->hasMany('Modules\Saas\Entities\Payment');
    }

    public function package()
    {
        return $this->belongsTo('Modules\Saas\Entities\Package')->withDefault();
    }

    public function company()
    {
        return $this->hasOne('Modules\Jobs\Entities\Company', 'user_id', 'id');
    }

    public function subscribed()
    {
        if (is_null($this->package_ends_at)) {
            return false;
        }
        return $this->package_ends_at->isFuture();
    }
    public function checkRemoveBrand()
    {
        if (!$this->subscribed()) {
            # code...
            if (config('saas.remove_branding') == true) {
                return true;
            }
            return false;
        }
        else{
            if ($this->package->remove_branding == true) {
                return true;
            }
            return false;
        }
    }

    public function checkDownloadPDF()
    {
        if (!$this->subscribed()) {
            # code...
            if (config('saas.download_pdf') == true) {
                return true;
            }
            return false;
        }
        else{
            if ($this->package->remove_branding == true) {
                return true;
            }
            return false;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new QueuedResetPassword($token));
    }

    public static function boot() {
        parent::boot();
        static::deleting(function($user) {
            $user->resumecvs()->delete();
       });
    }
    
}
