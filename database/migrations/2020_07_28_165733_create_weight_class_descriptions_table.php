<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightClassDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_class_descriptions', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->bigInteger('weight_class_id');
            $table->integer('language_id');
            $table->string('title');
            $table->string('unit');
            $table->primary(['weight_class_id',	'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_class_descriptions');
    }
}
