<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('process_achievements')) {
            Schema::create('process_achievements', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('requestwf_id');
                $table->unsignedInteger('process_achievement_status_id');
                $table->unsignedInteger('user_id');
                $table->string('process_achievement_comment');
                $table->dateTime('process_achievement_date', $precision = 0);
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
        Schema::dropIfExists('process_achievements');
    }
}
