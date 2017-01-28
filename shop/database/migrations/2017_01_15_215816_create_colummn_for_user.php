<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColummnForUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('gender');
            $table->string('city')->nullable()->after('address');
            $table->string('post_code')->nullable()->after('city');
            $table->string('state')->nullable()->after('post_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('post_code');
            $table->dropColumn('state');
        });
    }
}
