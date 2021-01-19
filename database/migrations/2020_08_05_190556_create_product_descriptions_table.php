<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->Integer('id')->default(0);
            $table->bigInteger('product_id');
            $table->bigInteger('language_id');
            $table->string('name' , 255)->unique();;
            $table->text('description' );
            $table->text('tag' );
            $table->string('meta_title' ,255 );
            $table->string('meta_description' ,255 );
            $table->string('meta_keyword' ,255 );
            $table->primary(['product_id' , 'language_id']);
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
        Schema::dropIfExists('product_descriptions');
    }
}
