<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->integer('type_id');
            $table->string('name');
            $table->string('slug');
            $table->string('plus')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->text('keywords')->nullable();
            $table->text('comment')->nullable();
            $table->integer('is_active');
            $table->integer('hot');
            $table->integer('sort');
            $table->integer('menu_main')->nullable();
            $table->integer('sort_hide')->nullable();
            $table->integer('menu_sm')->nullable();
            $table->string('images')->nullable();
            $table->string('icon')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('categories');
    }
}
