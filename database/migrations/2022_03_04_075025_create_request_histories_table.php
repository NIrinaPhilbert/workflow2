<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   if (!Schema::hasTable('request_histories')) {
            Schema::create('request_histories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('requestwf_id');
                $table->unsignedBigInteger('status_id');
                $table->unsignedBigInteger('owner_request_user_id');
                $table->unsignedBigInteger('sender_request_user_id');
                $table->unsignedBigInteger('destination_entity_id');
                $table->string('history_comment');
                $table->unsignedInteger('is_finished');
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
        Schema::dropIfExists('request_histories');
    }
}
