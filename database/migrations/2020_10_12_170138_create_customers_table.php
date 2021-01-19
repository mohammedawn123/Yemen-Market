<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->bigInteger('customer_group_id');
            $table->bigInteger('store_id'  )->default(0);
            $table->bigInteger('language_id'  )->default(1);
            $table->string('first_name' , 32);
            $table->string('last_name' , 32)->nullable()->default(null);
            $table->string('email' , 150)->unique();
            $table->string('password' , 150);
            $table->tinyInteger('sex' )->default(0)->comment('0:women, 1:men');
            $table->string('phone' , 10);
            $table->date('birthday')->nullable()->default(null);
            $table->string('postcode' , 10)->nullable()->default(null);
            $table->bigInteger('address_id' )->default(0);
            $table->string('address_1' , 100)->nullable()->default(null);
            $table->string('address_2' , 100)->nullable()->default(null);
            $table->string('city' , 100)->nullable()->default(null);
            $table->string('country' , 10)->default('YE');
            $table->string('remember_token' , 100)->nullable()->default(null);
            $table->tinyInteger('status' )->default(1);
            $table->string('ip' , 40)->nullable()->default(null);
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
        Schema::dropIfExists('customers');
    }
}
