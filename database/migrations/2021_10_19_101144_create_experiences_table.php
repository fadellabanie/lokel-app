<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('captain_id')->nullable()->index();
            $table->unsignedBigInteger('city_id')->nullable()->index();
            $table->unsignedBigInteger('country_id')->nullable()->index();
            $table->string('title');
            $table->string('code');
            $table->longText('description');
            $table->string('icon');
            $table->string('thumbnail');
            $table->tinyInteger('duration_type')->comment('day or minutes');
            $table->integer('duration')->comment('in minutes');
            $table->double('price');
            $table->longText('included');
            $table->longText('expect');
            $table->longText('faqs');
            $table->string('pick_up_address');
            $table->double('pick_up_lat', 10, 8)->nullable();
            $table->double('pick_up_lng', 10, 8)->nullable();
            $table->string('dropp_of_address');
            $table->double('dropp_of_lat', 10, 8)->nullable();
            $table->double('dropp_of_lng', 10, 8)->nullable();
            $table->string('meals');
            $table->string('status')->default(1);
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
        Schema::dropIfExists('experiences');
    }
}
