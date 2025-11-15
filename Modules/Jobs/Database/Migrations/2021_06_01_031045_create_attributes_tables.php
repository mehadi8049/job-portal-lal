<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTables extends Migration
{
    protected $tables = [
        'language_levels',
        'career_levels',
        'functional_areas',
        'genders',
        'industries',
        'job_experiences',
        'job_skills',
        'job_types',
        'job_shifts',
        'degree_levels',
        'major_subjects',
        'result_types',
        'marital_statuses',
        'ownership_types',
        'salary_periods',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tables as $table) {
            Schema::create('job_attributes_' . $table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 255);
                $table->tinyInteger('is_default')->default(0);
                $table->tinyInteger('is_active')->default(0);
                $table->integer('sort_order')->default(0);
                $table->timestamps();
            });
        }
        Schema::create('job_attributes_degree_types', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('degree_level_id');
            $table->string('name', 255);
            $table->tinyInteger('is_default')->default(0);
            $table->tinyInteger('is_active')->default(0);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->tables as $table) {
            Schema::dropIfExists('job_attributes_' . $table);
        }
        Schema::dropIfExists('job_attributes_degree_types');
    }
}
