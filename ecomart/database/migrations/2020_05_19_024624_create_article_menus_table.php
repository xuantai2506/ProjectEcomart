<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_menus', function (Blueprint $table) {
            $table->increments('article_menu_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('plus')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->integer('parent')->nullable();
            $table->text('comment')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
            $table->integer('sort');
            $table->integer('menu_main')->nullable();
            $table->integer('sort_hide')->nullable();
            $table->integer('menu_sm')->nullable();
            $table->string('images')->nullable();
            $table->string('icon')->nullable();
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
        Schema::dropIfExists('article_menus');
    }
}
