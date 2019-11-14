<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // Schema::table('cities', function (Blueprint $table) {
            
        //     $table->string('name')->nullable();
        //     $table->string('code')->nullable();
           
        // });

        // Schema::table('locations', function (Blueprint $table) {
            
        //     $table->unsignedDecimal('lat')->nullable();
        //     $table->unsignedDecimal('lon')->nullable();
        //     $table->string('name')->nullable();
        //     $table->string('area')->nullable();
        //     $table->unsignedInteger('city_id')->nullable();
        //     $table->string('district')->nullable();
           
        // });

        Schema::table('object_locations', function (Blueprint $table) {
            
            $table->unsignedInteger('object_type_id')->nullable()->change();
            // showroom, parking, gas_station, garage 
            // or sale
            $table->unsignedInteger('object_detail_id')->nullable()->change();
            // $table->unsignedInteger('location_id')->nullable();
            // $table->unsignedInteger('rating_number')->nullable();
            // $table->text('description')->nullable();
           
        });

        // Schema::table('brands', function (Blueprint $table) {
            
        //     $table->unsignedInteger('order_number')->nullable();
        //     $table->string('name')->nullable();
        //     $table->text('description')->nullable();
           
        // });

        // Schema::table('car_models', function (Blueprint $table) {
            
        //     $table->string('name')->nullable();
        //     $table->text('description')->nullable();
           
        // });

        // Schema::table('colors', function (Blueprint $table) {
            
        //     $table->string('name')->nullable();
        //     $table->string('code')->nullable();
           
        // });

        // Schema::table('cars', function (Blueprint $table) {
            
        //     $table->string('name')->nullable();
        //     $table->unsignedInteger('brand_id')->nullable();
        //     $table->unsignedInteger('model_id')->nullable();
        //     $table->unsignedInteger('year_manufacture')->nullable();
        //     //$table->unsignedDecimal('price');
        //     $table->unsignedInteger('product_status')->nullable();
        //     $table->unsignedInteger('kilometers_number')->nullable();
        //     $table->unsignedInteger('gearbox_number')->nullable();
        //     $table->unsignedInteger('fuel')->nullable();
        //     $table->unsignedInteger('color_id')->nullable();
        //     $table->unsignedInteger('rating_number')->nullable();
        //     $table->unsignedInteger('door_number')->nullable();
        //     $table->unsignedInteger('engine_name')->nullable();
        //     $table->unsignedInteger('power_number')->nullable();
        //     $table->unsignedInteger('furniture_type')->nullable();
        //     $table->unsignedInteger('exterior_type')->nullable();
        //     $table->unsignedInteger('equipment_type')->nullable();
        //     $table->text('description')->nullable();
        //     $table->text('photos')->nullable();
           
        // });

        Schema::table('sales', function (Blueprint $table) {
            
            // $table->unsignedInteger('seller_user_id')->nullable();
            // $table->unsignedInteger('object_type_id');
            $table->unsignedInteger('object_detail_id')->nullable()->change();
            // $table->unsignedInteger('status')->nullable();
            // $table->unsignedDecimal('price')->nullable();
            // $table->unsignedInteger('payment_type')->nullable();
            // $table->unsignedInteger('location_id')->nullable();
            // $table->string('location_alias')->nullable();
           
        });

        // Schema::table('object_types', function (Blueprint $table) {
            
        //     // showroom, parking, gas_station, garage
        //     // sale
        //     $table->string('name');
        //     $table->text('description')->nullable();
           
        // });

        Schema::table('favorites', function (Blueprint $table) {
            
            // $table->unsignedInteger('user_id');
            // // showroom, car, gas_station, parking, garage
            $table->unsignedInteger('object_type_id')->nullable()->change();
            // object_location, car table for get detail
            $table->unsignedInteger('object_detail_id')->nullable()->change();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
