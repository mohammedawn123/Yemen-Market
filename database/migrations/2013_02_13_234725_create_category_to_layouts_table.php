<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryToLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_to_layouts', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('store_id' );
            $table->integer('layout_id' );
            $table->timestamps();
            $table->primary(['category_id',	'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_to_layouts');
    }
}
