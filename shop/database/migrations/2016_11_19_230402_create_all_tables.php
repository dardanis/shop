<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('text');
            $table->string('type', 20);
            $table->timestamps();
        });

        Schema::create('advertisments_position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image_size');
            $table->integer('ord');
            $table->integer('active');
        });

        Schema::create('advertisments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->integer('type')->unsigned()->nullable()->index('advertisments_type_foreign');
            $table->integer('position')->unsigned()->nullable()->index('advertisments_position_foreign');
            $table->integer('product_id')->unsigned()->nullable()->index('advertisments_product_id_foreign');
            $table->text('image', 65535);
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        Schema::create('advertisments_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('ord');
            $table->integer('active');
        });

        Schema::create('area_details', function (Blueprint $table) {
            $table->integer('area_id', true);
            $table->string('area_name', 200);
            $table->string('area_description', 200);
            $table->string('area_alias', 200);
            $table->timestamps();
        });

        Schema::create('attributes_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_attribute_id');
            $table->string('item_value');
            $table->timestamps();
            $table->integer('related_item_id');
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('data_type');
            $table->string('gui_type');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->timestamps();
            $table->integer('sortorder');
            $table->boolean('related', 1)->nullable()->default(0);
            $table->integer('group_id')->nullable();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->timestamps();
            $table->integer('type_id');
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('description');
            $table->integer('category_id')->unsigned()->index();
            $table->integer('locale_id')->unsigned()->index();
            $table->timestamps();
            $table->unique(['category_id', 'locale_id']);
        });

        Schema::create('contact_infos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('gender', 100);
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('profession', 100);
            $table->string('activity_site', 100);
            $table->string('username', 100);
            $table->string('activity_society', 100);
            $table->string('phone', 100);
            $table->string('email', 100);
            $table->string('street', 200);
            $table->string('optional_street', 300);
            $table->string('zip', 100);
            $table->string('location', 200);
            $table->string('payment', 100);
            $table->boolean('in_products', 1)->default(0);
            $table->timestamps();
        });

        Schema::create('group_form_namings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('group_name', 300);
            $table->timestamps();
            $table->integer('category_id');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->timestamps();
            $table->integer('product_id')->nullable();
        });

        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('language', 2);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('file_id');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->float('total_paid');
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->dateTime('created_at')->default('0000-00-00 00:00:00');
        });

        Schema::create('product_adresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index('product_adresses_product_id_foreign');
            $table->string('tel');
            $table->string('mobile');
            $table->string('email');
            $table->string('web');
            $table->string('lon');
            $table->string('lat');
            $table->string('adress_line');
            $table->timestamps();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_id')->unsigned()->index('product_attributes_attribute_id_foreign');
            $table->integer('product_id')->unsigned()->index('product_attributes_product_id_foreign');
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('product_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->index('product_image_product_id_foreign');
            $table->integer('picture_id')->unsigned()->index('product_image_picture_id_foreign');
            $table->timestamps();
        });

        Schema::create('product_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('teaser', 100);
            $table->string('description');
            $table->string('search_keywords', 200)->nullable();
            $table->string('slug');
            $table->integer('product_id')->unsigned()->index();
            $table->integer('locale_id')->unsigned()->index();
            $table->timestamps();
            $table->unique(['product_id', 'locale_id']);
        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->integer('sort_order');
            $table->timestamps();
            $table->string('header_color', 200)->nullable();
            $table->string('background_color', 200)->nullable();
            $table->text('text_color', 65535)->nullable();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index('products_user_id_foreign');
            $table->integer('category_id')->unsigned()->index('products_category_id_foreign');
            $table->integer('type_id');
            $table->integer('subcategory_id')->unsigned()->index('products_subcategory_id_foreign');
            $table->integer('sub_sub_category_id');
            $table->decimal('price', 6);
            $table->boolean('availability')->default(1);
            $table->boolean('status')->default(0);
            $table->boolean('sponsored')->default(0);
            $table->string('thumbnail');
            $table->string('thumbnail_back', 250);
            $table->float('lat', 10, 7)->nullable();
            $table->float('lng', 10, 7)->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
            $table->integer('rating_count')->default(0);
            $table->float('rating_cache')->default(0.00);
            $table->integer('views')->default(0);
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('rating');
            $table->text('comment', 65535);
            $table->boolean('approved')->default(1);
            $table->boolean('spam')->default(0);
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40);
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->text('payload', 65535);
            $table->integer('last_activity');
            $table->integer('user_id')->nullable();
        });

        Schema::create('slider_products', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('product_id');
            $table->integer('priority');
            $table->timestamps();
        });

        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->index('subcategories_category_id_foreign');
            $table->timestamps();
            $table->integer('parent_sub_category_id')->nullable();
        });

        Schema::create('subcategory_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('subcategory_id')->unsigned()->index();
            $table->integer('locale_id')->unsigned()->index();
            $table->timestamps();
            $table->integer('parent_sub_category_id')->nullable();
            $table->unique(['subcategory_id', 'locale_id']);
        });

        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->string('description')->nullable();
            $table->string('de')->nullable();
            $table->string('en')->nullable();
            $table->string('fr')->nullable();
            $table->string('it')->nullable();
            $table->timestamps();
        });

        Schema::create('type_area_details', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('area_details_id');
            $table->integer('type_id');
            $table->timestamps();
        });

        Schema::create('user_follows', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('follow_user_id');
            $table->integer('follower_user_id');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index('users_role_id_foreign');
            $table->string('profile');
            $table->string('avatar');
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password', 60);
            $table->string('activation_code');
            $table->boolean('active')->default(0);
            $table->boolean('resent');
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->boolean('stripe_active')->default(0);
            $table->string('stripe_id')->nullable();
            $table->string('stripe_subscription')->nullable();
            $table->string('stripe_plan', 100)->nullable();
            $table->string('last_four', 4)->nullable();
            $table->string('token')->nullable();
            $table->dateTime('trial_ends_at')->nullable();
            $table->dateTime('subscription_ends_at')->nullable();
            $table->boolean('receive_emails', 1)->default(0);
            $table->boolean('is_superadmin', 1)->default(0);
        });
    }


    public function down()
    {
        Schema::drop('users');
        Schema::drop('user_follows');
        Schema::drop('type_area_details');
        Schema::drop('translations');
        Schema::drop('subcategory_translations');
        Schema::drop('subcategories');
        Schema::drop('sliders');
        Schema::drop('slider_products');
        Schema::drop('sessions');
        Schema::drop('roles');
        Schema::drop('reviews');
        Schema::drop('products');
        Schema::drop('product_types');
        Schema::drop('product_translations');
        Schema::drop('product_image');
        Schema::drop('product_attributes');
        Schema::drop('product_adresses');
        Schema::drop('password_resets');
        Schema::drop('orders');
        Schema::drop('order_items');
        Schema::drop('locales');
        Schema::drop('images');
        Schema::drop('group_form_namings');
        Schema::drop('contact_infos');
        Schema::drop('category_translations');
        Schema::drop('categories');
        Schema::drop('attributes');
        Schema::drop('attributes_lists');
        Schema::drop('area_details');
        Schema::drop('advertisments_position');
        Schema::drop('advertisments');
        Schema::drop('advertisments_types');
        Schema::drop('activity_log');
    }
}
