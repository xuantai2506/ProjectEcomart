<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id')->unique();
            $table->integer('product_menu_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('images')->nullable();
            $table->string('images_note')->nullable();
            $table->bigInteger('upload_id')->nullable();
            $table->float('sale')->nullable();
            $table->float('price')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('product_keys')->nullable();
            $table->text('comment')->nullable();
            $table->longtext('content')->nullable();
            $table->integer('producer')->nullable();
            $table->string('producer_name')->nullable();
            $table->integer('combo')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
            $table->float('percent')->nullable();
            $table->integer('pin')->nullable();
            $table->bigInteger('views')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('keywords')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('products');
    }
}
