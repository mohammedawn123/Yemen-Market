<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeGroupDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_g_descriptions', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->bigInteger('a_g_id');
            $table->integer('language_id' );
            $table->longText('name');
            $table->primary(['a_g_id',	'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_group_descriptions');
    }
}
