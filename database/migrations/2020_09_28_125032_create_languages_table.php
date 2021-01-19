<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('language_id');
            $table->string('name', 100);
            $table->string('code', 50)->unique();
            $table->string('image', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('directory' ,3)->nullable()->default('ltr');
            $table->tinyInteger('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
