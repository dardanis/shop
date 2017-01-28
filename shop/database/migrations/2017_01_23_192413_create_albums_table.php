<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('album_pivot', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('album_id');
            $table->string('image');
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('albums')->onDelete('RESTRICT')->onUpdate('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('album_pivot');
        Schema::drop('albums');
    }
}
