<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysForAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisments', function (Blueprint $table) {
            $table->foreign('position')->references('id')->on('advertisments_position')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('type')->references('id')->on('advertisments_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });


        Schema::table('category_translations', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('locale_id')->references('id')->on('locales')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('product_adresses', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('product_attributes', function (Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('attributes')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('product_image', function (Blueprint $table) {
            $table->foreign('picture_id')->references('id')->on('images')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('product_translations', function (Blueprint $table) {
            $table->foreign('locale_id')->references('id')->on('locales')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });


        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('subcategories', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });


        Schema::table('subcategory_translations', function (Blueprint $table) {
            $table->foreign('locale_id')->references('id')->on('locales')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
        });

        Schema::table('subcategory_translations', function (Blueprint $table) {
            $table->dropForeign('subcategory_translations_locale_id_foreign');
            $table->dropForeign('subcategory_translations_subcategory_id_foreign');
        });


        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropForeign('subcategories_category_id_foreign');
        });


        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_category_id_foreign');
            $table->dropForeign('products_subcategory_id_foreign');
            $table->dropForeign('products_user_id_foreign');
        });

        Schema::table('product_translations', function (Blueprint $table) {
            $table->dropForeign('product_translations_locale_id_foreign');
            $table->dropForeign('product_translations_product_id_foreign');
        });


        Schema::table('product_image', function (Blueprint $table) {
            $table->dropForeign('product_image_picture_id_foreign');
            $table->dropForeign('product_image_product_id_foreign');
        });


        Schema::table('product_attributes', function (Blueprint $table) {
            $table->dropForeign('product_attributes_attribute_id_foreign');
            $table->dropForeign('product_attributes_product_id_foreign');
        });


        Schema::table('product_adresses', function (Blueprint $table) {
            $table->dropForeign('product_adresses_product_id_foreign');
        });

        Schema::table('category_translations', function (Blueprint $table) {
            $table->dropForeign('category_translations_category_id_foreign');
            $table->dropForeign('category_translations_locale_id_foreign');
        });


        Schema::table('advertisments', function (Blueprint $table) {
            $table->dropForeign('advertisments_position_foreign');
            $table->dropForeign('advertisments_product_id_foreign');
            $table->dropForeign('advertisments_type_foreign');
        });
    }
}
