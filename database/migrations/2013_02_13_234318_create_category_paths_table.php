<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryPathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_paths', function (Blueprint $table) {
            $table->integer('category_id');
            $table->integer('path_id' );
            $table->integer('level' );
            $table->timestamps();
            $table->primary(['category_id',	'path_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_paths');
    }
}
