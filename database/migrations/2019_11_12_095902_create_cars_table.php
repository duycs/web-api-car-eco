<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->unsignedInteger('year_manufacture')->nullable();
            //$table->unsignedDecimal('price');
            $table->unsignedInteger('product_status')->nullable();
            $table->unsignedInteger('kilometers_number')->nullable();
            $table->unsignedInteger('gearbox_number')->nullable();
            $table->unsignedInteger('fuel')->nullable();
            $table->unsignedInteger('color_id')->nullable();
            $table->unsignedInteger('rating_number')->nullable();
            $table->unsignedInteger('door_number')->nullable();
            $table->unsignedInteger('engine_name')->nullable();
            $table->unsignedInteger('power_number')->nullable();
            $table->unsignedInteger('furniture_type')->nullable();
            $table->unsignedInteger('exterior_type')->nullable();
            $table->unsignedInteger('equipment_type')->nullable();
            $table->text('description')->nullable();
            $table->text('photos')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
