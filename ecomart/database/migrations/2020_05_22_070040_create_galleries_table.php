<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->increments('gallery_id');
            $table->integer('product_menu_id');
            $table->integer('gallery_menu_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('images')->nullable();
            $table->bigInteger('upload_id')->nullable();
            $table->text('comment')->nullable();
            $table->text('content')->nullable();
            $table->string('link')->nullable();
            $table->integer('is_active')->nullable();
            $table->integer('hot')->nullable();
            $table->bigInteger('views')->nullable();
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
        Schema::dropIfExists('galleries');
    }
}
