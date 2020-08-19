<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_menus', function (Blueprint $table) {
            $table->increments('others_menu_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('plus')->nullable();
            $table->integer('menu')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('sort');
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
        Schema::dropIfExists('other_menus');
    }
}
