<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_country_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('country_id');
            $table->string('sort_name', 5)->nullable();
            $table->string('phone_code', 7)->nullable();
            $table->string('currency', 60)->nullable();
            $table->string('code', 7)->nullable();
            $table->string('symbol', 7)->nullable();
            $table->string('thousand_separator', 2)->nullable();
            $table->string('decimal_separator', 2)->nullable();
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
        Schema::dropIfExists('location_country_details');
    }
}
