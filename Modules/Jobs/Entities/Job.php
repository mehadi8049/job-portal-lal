<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Tracklink\Entities\Tracklink;

class Job extends Model
{
    protected $table = 'jobs_list';
    
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'responbilities',
        'requirements',
        'benefits',
        'country_id',
        'state_id',
        'city_id',
        'is_freelance',
        'career_level_id',
        'salary_from',
        'salary_to',
        'hide_salary',
        'salary_currency',
        'salary_period_id',
        'functional_area_id',
        'job_type_id',
        'job_shift_id',
        'num_of_positions',
        'gender_id',
        'expiry_date',
        'degree_level_id',
        'job_experience_id',
        'is_active',
        'is_featured',
        'search',
        'slug',
        'job_skill_id',
        'salary_currency',
    ];
   
    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_freelance' => 'boolean',
        'hide_salary' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', '=', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', '=', 1);
    }

    public function company()
    {
        return $this->belongsTo('Modules\Jobs\Entities\Company','company_id');
    }

    public function city()
    {
        return $this->belongsTo('Modules\Location\Entities\City','city_id');
    }

    public function job_type()
    {
        return $this->belongsTo('Modules\Jobs\Entities\JobType','job_type_id');
    }

    public function functional_area()
    {
        return $this->belongsTo('Modules\Jobs\Entities\FunctionalArea','functional_area_id');
    }

    public function job_experience()
    {
        return $this->belongsTo('Modules\Jobs\Entities\JobExperience','job_experience_id');
    }

    public function job_salary_period()
    {
        return $this->belongsTo('Modules\Jobs\Entities\SalaryPeriod','salary_period_id');
    }

    public function gender()
    {
        return $this->belongsTo('Modules\Jobs\Entities\Gender','gender_id');
    }

    public function degree_level()
    {
        return $this->belongsTo('Modules\Jobs\Entities\DegreeLevel','degree_level_id');
    }

    public function career_level()
    {
        return $this->belongsTo('Modules\Jobs\Entities\CareerLevel','career_level_id');
    }

    public function tracklinks()
    {
        return $this->hasMany(Tracklink::class, 'target_id', 'id')->where('target_class', '=', Job::class);
    }

    public function applicants()
  {
      return $this->hasMany(JobApplicant::class, 'job_id', 'id');
  }
}
