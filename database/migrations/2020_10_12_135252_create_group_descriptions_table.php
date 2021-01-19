<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_descriptions', function (Blueprint $table) {
            $table->bigInteger('customer_group_id');
            $table->bigInteger('language_id' );
            $table->string('name' , 30 );
            $table->longText('description'  );
            $table->primary(['customer_group_id' , 'language_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_descriptions');
    }
}
