<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('company_name', 155)->nullable();
            $table->string('company_email', 100)->nullable();
            $table->string('company_ceo', 60)->nullable();
            $table->integer('industry_id')->nullable()->default(0);
            $table->integer('ownership_type_id')->nullable()->default(0);
            $table->mediumText('description')->nullable();
            $table->string('location', 155)->nullable();
            $table->integer('no_of_offices')->nullable();
            $table->string('website', 155)->nullable();
            $table->string('no_of_employees', 15)->nullable();
            $table->string('established_in', 12)->nullable();
            $table->string('fax', 30)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('logo', 155)->nullable();
            $table->integer('country_id')->nullable()->default(0);
            $table->integer('state_id')->nullable()->default(0);
            $table->integer('city_id')->nullable()->default(0);
            $table->string('slug', 155)->nullable();
            $table->string('facebook', 250)->nullable();
            $table->string('twitter', 250)->nullable();
            $table->string('linkedin', 250)->nullable();
            $table->string('pinterest', 250)->nullable();
            $table->string('youtube', 250)->nullable();
            $table->text('map')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->boolean('is_featured')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
