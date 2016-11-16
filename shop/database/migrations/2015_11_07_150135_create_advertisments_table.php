<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertismentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisments',function(Blueprint $table){
			$table->increments('id');
			$table->string('name');
			$table->integer('type')->unsigned()->nullable();
			$table->integer('position')->unsigned()->nullable();
			$table->foreign('type')->references('id')->on('advertisments_types');
			$table->foreign('position')->references('id')->on('advertisments_position');
			$table->integer('product_id')->unsigned()->nullable();
			$table->foreign('product_id')->references('id')->on('products');
			$table->text('image');
			$table->boolean('status')->default(0);
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
		Schema::drop('advertisments');
	}

}
