<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('validation_statuses')) {
            Schema::create('processings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('requestwf_id');
                $table->unsignedBigInteger('etat_id');
                $table->unsignedBigInteger('owner_request_user_id');
                $table->unsignedBigInteger('sender_request_user_id');
                $table->string('process_comment');
                $table->unsignedBigInteger('is_finished');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processings');
    }
}
