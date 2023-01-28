<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeRequestToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('type_request_tools');
        if (!Schema::hasTable('validation_statuses')) {
                Schema::create('type_request_tools', function (Blueprint $table) {
                    $table->bigIncrements('id');
                    $table->unsignedBigInteger('type_request_id');
                    $table->unsignedBigInteger('tool_id');
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
        Schema::dropIfExists('type_request_tools');
    }
}
