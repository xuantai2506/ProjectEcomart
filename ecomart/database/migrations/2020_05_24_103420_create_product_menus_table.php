<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_menus', function (Blueprint $table) {
            $table->increments('product_menu_id')->unicode();
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('plus')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('parent')->nullable();
            $table->string('images')->nullable();
            $table->integer('sort');
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
            $table->integer('user_id')->nullable();
            $table->string('class')->nullable();
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
        Schema::dropIfExists('product_menus');
    }
}
