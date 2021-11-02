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
            $table->tinyInteger('duration_type')->comment('1 day or  2 minutes');
            $table->integer('duration')->comment('in minutes');
            $table->integer('capacity')->default(1);
            $table->decimal('price',8,2);
            $table->longText('included');
            $table->longText('expect');
            $table->longText('faqs');
            $table->double('rate')->default(0);
            $table->string('pick_up_address');
            $table->decimal('pick_up_lat', 12, 8)->nullable();
            $table->decimal('pick_up_lng', 12, 8)->nullable();
            $table->string('drop_of_address');
            $table->decimal('drop_of_lat', 12, 8)->nullable();
            $table->decimal('drop_of_lng', 12, 8)->nullable();
            $table->string('meals');
            $table->string('status')->default(1)->comment('0  - 1 - 2 - 3');
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
