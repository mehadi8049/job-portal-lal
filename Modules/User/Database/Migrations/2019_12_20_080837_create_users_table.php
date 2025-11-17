<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role')->default('user');

            //personal information
            $table->string('name', 190);
            $table->string('father_name', 190)->nullable();
            $table->string('mother_name', 190)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('national_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->date('passport_issue_date')->nullable();
            $table->string('primary_mobile')->nullable();
            $table->string('secondary_mobile')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('email', 190)->unique();
            $table->string('alternate_email')->nullable();
            $table->string('blood_group')->nullable();
            $table->decimal('height_meters', 5, 2)->nullable();
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 190);;
            $table->integer('package_id')->nullable();
            $table->dateTime('package_ends_at')->nullable();
            $table->text('settings')->nullable();

            //address
            $table->text('present_address')->nullable();
            $table->text('parmanent_address')->nullable();

            //career and application information
            $table->text('objective')->nullable();
            $table->integer('present_salary')->default(0);
            $table->integer('expected_salary')->default(0);
            $table->string('job_level')->nullable();
            $table->string('job_nature')->nullable();

            //other relavand information
            $table->longText('career_summary')->nullable();
            $table->text('special_qualification')->nullable();
            $table->json('keywords')->nullable();


            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
