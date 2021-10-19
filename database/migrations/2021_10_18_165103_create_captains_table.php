<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaptainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->unsignedBigInteger('nationality_id')->nullable()->index();
            $table->string('full_name');
            $table->string('code')->unique();
            $table->string('email');
            $table->string('mobile');
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('country_code');
            $table->string('password');
            $table->string('country_of_residence');
            $table->string('avatar')->nullable();
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->double('rate')->default(0);
            $table->string('front_personal');
            $table->string('back_personal');
            $table->string('address');
            $table->string('cv');
            $table->string('drive_license');
            $table->string('car_model');
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->date('block_date')->nullable()->comment('Block date until');
            $table->boolean('suspend')->default(false)->comment('0 is active - 1 is block');
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('captains');
    }
}
