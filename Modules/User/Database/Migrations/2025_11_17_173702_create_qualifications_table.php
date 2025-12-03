<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('education_level');
            $table->string('degree_title');
            $table->string('major')->nullable();
            $table->string('institute_name')->nullable();

            $table->string('result_type')->nullable();
            $table->decimal('cgpa', 3, 2);
            $table->integer('scale')->nullable();

            $table->year('passing_year')->nullable();
            $table->integer('duration_years')->nullable();

            $table->text('achievement')->nullable();
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
        Schema::dropIfExists('qualifications');
    }
}
