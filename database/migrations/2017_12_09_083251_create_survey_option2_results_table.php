<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveyOption2ResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_option2_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id');
            $table->integer('user_id');
            $table->integer('size_id')->nullable();
            $table->string('img_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survey_option2_results');
    }
}
