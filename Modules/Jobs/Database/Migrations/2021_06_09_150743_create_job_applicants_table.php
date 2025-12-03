<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('job_id')->nullable();
            $table->bigInteger('company_id')->nullable();
            $table->string('fullname', 191);
            $table->string('email', 191);
            $table->text('description')->nullable();
            $table->string('resume_link', 191)->nullable();
            $table->string('resume_pdf', 191)->nullable();
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
        Schema::dropIfExists('job_applicants');
    }
}
