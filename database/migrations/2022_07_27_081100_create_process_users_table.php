<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('process_users')) {
            Schema::create('process_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('process_id');
                $table->unsignedBigInteger('entity_id'); 
                $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('process_users');
    }
}
