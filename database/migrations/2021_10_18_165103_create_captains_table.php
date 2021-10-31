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
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('code')->unique()->index();
            $table->string('email')->index();
            $table->string('mobile')->index();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('country_code');
            $table->string('password');
            $table->string('country_of_residence');
            $table->string('avatar')->nullable();
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->double('rate')->default(0);
            $table->integer('number_of_trips')->default(0);
            $table->string('front_personal');
            $table->string('back_personal');
            $table->string('address');
            $table->string('cv')->nullable();
            $table->boolean('drive_license')->comment('0 no - 1 yes');
            $table->boolean('is_smoker')->nullable()->comment('0  no - 1 yes');
            $table->string('car_model')->nullable();
            $table->string('bio')->nullable();
            $table->string('languages')->nullable();
            $table->text('remember_token')->nullable();
            $table->text('device_token')->nullable();
            $table->date('block_date')->nullable()->comment('Block date until');
            $table->boolean('suspend')->default(false)->comment('0 is active - 1 is block');
            $table->boolean('status')->default(false)->comment('1 is verify - 0 is unverify');
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
