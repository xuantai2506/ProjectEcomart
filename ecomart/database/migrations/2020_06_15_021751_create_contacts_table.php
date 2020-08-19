<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contact_id');
            $table->string('companyname');
            $table->string('fullname');
            $table->string('email')->nullable();
            $table->string('birthday');
            $table->integer('cmnd');
            $table->string('address');
            $table->string('phone');
            $table->integer('msthue');
            $table->integer('stk');
            $table->string('kinhnghiem');
            $table->integer('slnhanvien');
            $table->string('ptvanchuyen');
            $table->string('comments')->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
