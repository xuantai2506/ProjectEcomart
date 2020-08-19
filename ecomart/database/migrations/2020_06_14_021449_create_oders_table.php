<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->string('name');
            $table->string('name_dif')->nullable();
            $table->string('phone');
            $table->string('phone_dif')->nullable();
            $table->string('email');
            $table->string('email_dif')->nullable();
            $table->string('address_detail');
            $table->string('address');
            $table->string('address_dif_detail')->nullable();
            $table->string('address_dif')->nullable();
            $table->string('content')->nullable();
            $table->string('method_purchase');
            $table->string('id_product');
            $table->string('quantity');
            $table->string('user_id');
            $table->integer('is_view')->nullable();
            $table->integer('is_show')->nullable();
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
        Schema::dropIfExists('oders');
    }
}
