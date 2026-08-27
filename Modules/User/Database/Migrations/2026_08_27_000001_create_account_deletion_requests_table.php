<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountDeletionRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('account_deletion_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('account_deletion_requests');
    }
}
