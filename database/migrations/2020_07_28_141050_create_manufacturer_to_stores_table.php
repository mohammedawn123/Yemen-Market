<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturerToStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturer_to_stores', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->bigInteger('manufacturer_id');
            $table->bigInteger('store_id');
            $table->primary(['manufacturer_id',	'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturer_to_stores');
    }
}
