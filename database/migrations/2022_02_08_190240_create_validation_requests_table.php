<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('validation_requests');
        if (!Schema::hasTable('validation_requests')) {
            Schema::create('validation_requests', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('type_request_id');
                $table->unsignedBigInteger('tool_id');
                $table->unsignedBigInteger('entity_id');
                $table->integer('rank');
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
        Schema::dropIfExists('validation_requests');
    }
}
