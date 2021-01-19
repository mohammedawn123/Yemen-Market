<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_descriptions', function (Blueprint $table) {
            $table->integer('id')->default(0);
            $table->bigInteger('option_id');
            $table->integer('language_id' );
            $table->longText('name');
            $table->primary(['option_id',	'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_descriptions');
    }
}
