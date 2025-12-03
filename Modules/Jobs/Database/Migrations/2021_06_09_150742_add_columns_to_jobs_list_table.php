<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobs_list', function (Blueprint $table) {
            $table->text('responbilities')->nullable();
            $table->text('requirements')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs_list', function (Blueprint $table) {
            $table->dropColumn('responbilities');
            $table->dropColumn('requirements');
        });
    }
}
