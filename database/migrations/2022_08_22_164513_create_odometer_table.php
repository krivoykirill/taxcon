<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdometerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odometer', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('car_id')->nullable();
            $table->integer('odometer_start');
            $table->dateTime('odometer_start_date');
            $table->integer('odometer_end')->nullable();
            $table->dateTime('odometer_end_date')->nullable();
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
        Schema::dropIfExists('odometer');
    }
}
