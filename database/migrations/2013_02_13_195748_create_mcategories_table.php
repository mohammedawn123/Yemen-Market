<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcategories', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->bigIncrements('category_id');
            $table->string('image', 255)->nullable()->default(null);
            $table->integer('parent_id' )->unique()->default(0);
            $table->tinyInteger('top' );
            $table->integer('column' );
            $table->integer('sort_order' )->default(0);
            $table->tinyInteger('status' )->default(0);
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists('mcategories');
    }
}
