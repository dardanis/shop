<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->double('lat', 10, 7)->after('thumbnail');
            $table->double('lng', 10, 7)->after('lat');
			$table->string('address')->after('lng');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('lat');
			$table->dropColumn('lng');
			$table->dropColumn('address');
		});
	}

}
