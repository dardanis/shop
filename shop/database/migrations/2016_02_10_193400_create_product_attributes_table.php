<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductAttributesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_attributes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('attribute_id')->unsigned();
			$table->integer('product_id')->unsigned();

			$table->string('value');
			//$table->foreign('attribute_id')->references('id')->on('attributes');
			//$table->foreign('product_id')->references('id')->on('products');
			$table->timestamps();
		});

		Schema::table('product_attributes',function($table){
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_attributes');
	}


}
