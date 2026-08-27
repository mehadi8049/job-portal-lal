<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakePhoneNullableInAccountDeletionRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('account_deletion_requests', function (Blueprint $table) {
            $table->string('phone')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('account_deletion_requests', function (Blueprint $table) {
            $table->string('phone')->change();
        });
    }
}
