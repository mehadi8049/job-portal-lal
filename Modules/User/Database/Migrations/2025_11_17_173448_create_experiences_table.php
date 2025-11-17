<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('company_name')->nullable();
            $table->string('company_business')->nullable();
            $table->string('designation')->nullable();
            $table->string('department')->nullable();

            $table->date('employment_from')->nullable();
            $table->date('employment_to')->nullable();
            $table->boolean('is_current')->default(0);

            $table->longText('responsibilities')->nullable();
            $table->json('area_of_expertise')->nullable();

            $table->string('company_location')->nullable();

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
        Schema::dropIfExists('experiences');
    }
}
