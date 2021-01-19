<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->biginteger('product_id');
            $table->string('name', 100);
            $table->integer('price')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('total_price')->default(0);
            $table->integer('tax')->default(0);
            $table->string('sku', 50);
            $table->string('currency', 10);
            $table->float('exchange_rate')->nullable();
            $table->string('attribute', 100)->nullable();
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
        Schema::dropIfExists('shop_order_details');
    }
}
