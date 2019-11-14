<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('object_type_id');
            // showroom, parking, gas_station, garage 
            // or sale
            $table->unsignedInteger('object_detail_id');
            $table->unsignedInteger('location_id')->nullable();
            $table->unsignedInteger('rating_number')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('object_locations');
    }
}
