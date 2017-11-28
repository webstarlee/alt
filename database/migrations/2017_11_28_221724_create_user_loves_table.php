<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_loves', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('image_id');
            $table->integer('user_id');
            $table->boolean('love_type');
            $table->string('pos_top');
            $table->string('pos_left');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_loves');
    }
}
