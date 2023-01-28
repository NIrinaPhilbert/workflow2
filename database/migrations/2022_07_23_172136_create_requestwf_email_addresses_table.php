<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestwfEmailAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('requestwf_email_addresses')) {
            Schema::create('requestwf_email_addresses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('requestwf_id'); 
                $table->unsignedBigInteger('reply_email_address_id');
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
        Schema::dropIfExists('requestwf_email_addresses');
    }
}
