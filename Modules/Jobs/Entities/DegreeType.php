<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Model;

class DegreeType extends Model
{
    protected $table = 'job_attributes_degree_types';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'is_default',
        'is_active',
        'sort_order',
        'degree_level_id',
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

    public function degreeLevel()
    {
        return $this->belongsTo(DegreeLevel::class, 'degree_level_id', 'id');
    }
}