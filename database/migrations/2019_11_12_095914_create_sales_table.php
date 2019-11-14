<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seller_user_id')->nullable();
            $table->unsignedInteger('object_type_id');
            $table->unsignedInteger('object_detail_id');
            $table->unsignedInteger('status')->nullable();
            $table->unsignedDecimal('price')->nullable();
            $table->unsignedInteger('payment_type')->nullable();
            $table->unsignedInteger('location_id')->nullable();
            $table->string('location_alias')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
