<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoriesSliderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories_slider', function(Blueprint $table)
    {
	        $table->integer('category_id')->unsigned();
	        $table->integer('slider_id')->unsigned();
    	});

    	Schema::table('categories_slider', function(Blueprint $table)
	    {
	        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');;
	        $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');;
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories_slider');
	}

}
