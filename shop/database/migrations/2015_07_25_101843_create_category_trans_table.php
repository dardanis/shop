<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTransTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategory_translations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('slug');

			$table->integer('subcategory_id')->unsigned()->index();
			$table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

			$table->integer('locale_id')->unsigned()->index();
			$table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

			$table->unique(['subcategory_id', 'locale_id']);

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
		Schema::drop('subcategory_translations');
	}

}
