<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs_list', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->nullable();
            $table->string('title', 200)->nullable();
            $table->text('description')->nullable();
            $table->text('benefits')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->boolean('is_freelance')->nullable()->default(0);
            $table->integer('career_level_id')->nullable();
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->boolean('hide_salary')->nullable()->default(0);
            $table->string('salary_currency', 5)->nullable();
            $table->integer('salary_period_id')->nullable();
            $table->integer('functional_area_id')->nullable();
            $table->integer('job_type_id')->nullable();
            $table->integer('job_shift_id')->nullable();
            $table->integer('num_of_positions')->nullable();
            $table->integer('gender_id')->nullable();
            $table->timestamp('expiry_date')->nullable();
            $table->integer('degree_level_id')->nullable();
            $table->integer('job_experience_id')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('is_featured')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->text('search')->nullable();
            $table->string('slug', 210)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs_list');
    }
}
