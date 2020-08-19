<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('article_id');
            $table->integer('article_menu_id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('images')->nullable();
            $table->string('images_note')->nullable();
            $table->string('address')->nullable();
            $table->string('upload_id')->nullable();
            $table->text('comment')->nullable();
            $table->longtext('content')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
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
        Schema::dropIfExists('articles');
    }
}
