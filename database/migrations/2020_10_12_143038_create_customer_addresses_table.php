<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->bigIncrements('address_id');
            $table->bigInteger('customer_id');
            $table->string('first_name' , 32);
            $table->string('last_name' , 32)->nullable()->default(null);
            $table->string('address_1' , 100)->nullable()->default(null);
            $table->string('address_2' , 100)->nullable()->default(null);
            $table->string('city' , 100)->nullable()->default(null);
            $table->string('postcode' , 10)->nullable()->default(null);
            $table->string('country' , 10)->default('YE');
            $table->string('phone' , 32);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cusomer_addresses');
    }
}
