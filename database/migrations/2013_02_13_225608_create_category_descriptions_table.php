<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_descriptions', function (Blueprint $table) {
          $table->integer('id')->nullable();
            $table->bigInteger('category_id');
           $table->bigInteger('language_id' );
            $table->string('name' , 255)->unique();
            $table->longText('description');
            $table->string('meta_title' , 255);
            $table->string('meta_description' , 255);
            $table->string('meta_keyword' , 255);
            $table->primary(['category_id' , 'language_id']);
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
        Schema::dropIfExists('category_descriptions');
    }
}
