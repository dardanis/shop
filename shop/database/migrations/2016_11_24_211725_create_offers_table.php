<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('offers_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('offers_id');
            $table->integer('locale_id');
            $table->string('name');
            $table->string('teaser');
            $table->string('slug');
            $table->string('description');
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
        Schema::drop('offers_translations');
        Schema::drop('offers');
    }
}
