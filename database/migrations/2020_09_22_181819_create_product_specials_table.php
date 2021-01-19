<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSpecialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_specials', function (Blueprint $table) {
            $table->bigIncrements('product_special_id');
            $table->bigInteger('product_id');
            $table->bigInteger('customer_group_id');
            $table->int('priority' , 5)->default(1);
            $table->decimal('price' , 15 ,4 )->default(0.0000);
            $table->date('date_start' )->nullable();
            $table->date('date_end' )->nullable();
            $table->primary('product_special_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_specials');
    }
}
