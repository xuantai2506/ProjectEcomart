<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_menus', function (Blueprint $table) {
            $table->increments('gallery_menu_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('parent')->nullable();
            $table->string('images')->nullable();
            $table->integer('sort');
            $table->text('comment')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
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
        Schema::dropIfExists('gallery_menus');
    }
}
