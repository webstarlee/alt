<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_terms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('terms_use')->nullable();
			$table->text('privacy_policy')->nullable();
			$table->text('about_us')->nullable();
			$table->text('how_it_work')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_terms');
    }
}
