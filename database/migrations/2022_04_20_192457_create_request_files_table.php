<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    if (!Schema::hasTable('request_files')) {
            Schema::create('request_files', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('request_id');
                $table->text('filename');
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
        Schema::dropIfExists('request_files');
    }
}
