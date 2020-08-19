<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('role_id');
            $table->string('user_name')->nullable();
            $table->string('password')->nullable();
            $table->string('full_name')->nullable();
            $table->integer('gender')->nullable();
            $table->integer('birthday')->nullable();
            $table->string('apply')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('comment')->nullable();
            $table->string('code')->nullable();
            $table->integer('is_show')->nullable();
            $table->integer('city')->nullable();
            $table->string('district')->nullable();
            $table->integer('sort');
            $table->string('images')->nullable();
            $table->integer('is_active');
            $table->string('token')->nullable();
            $table->bigInteger('vote')->nullable();
            $table->bigInteger('click_vote')->nullable();
            $table->integer('user_id_edit')->nullable();
            $table->string('province_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('ward_id')->nullable();
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
        Schema::dropIfExists('core_users');
    }
}
