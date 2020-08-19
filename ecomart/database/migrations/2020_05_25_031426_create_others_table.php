<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('others', function (Blueprint $table) {
            $table->increments('others_id');
            $table->integer('others_menu_id');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('p_from')->nullable();
            $table->string('p_to')->nullable();
            $table->integer('sort');
            $table->integer('is_active');
            $table->integer('hot');
            $table->integer('user_id')->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('others');
    }
}
