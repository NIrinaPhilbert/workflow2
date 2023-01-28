<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplyEmailAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('reply_email_addresses')) {
        Schema::create('reply_email_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rea_icon');
            $table->string('rea_email');
            $table->string('rea_name');
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
        Schema::dropIfExists('reply_email_addresses');
    }
}
