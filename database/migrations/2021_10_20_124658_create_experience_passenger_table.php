<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencePassengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_passenger', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('experience_id')->index();
            $table->unsignedBigInteger('passenger_id')->index();
            $table->tinyInteger('status')->default(0)->comment('0 witting - 1 start - 2 finish')->index();
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience_passenger');
    }
}
