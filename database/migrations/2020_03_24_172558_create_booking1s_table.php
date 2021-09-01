<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooking1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('booking1s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('do_name');
            $table->string('p_name');
            $table->string('p_gender');
            $table->string('p_nation');
            $table->string('p_address');
            $table->string('p_age');
            $table->string('p_job');
            $table->string('p_phone');
            $table->string('p_datein');
            $table->string('p_dateexit');
            $table->string('p_day');
            $table->string('p_wating');
            $table->string('username');
            $table->string('pull');
            $table->string('dis');
            $table->string('net');
            $table->string('all_amount');
            $table->string('relation_doc');
            $table->string('leftover');
            $table->string('docter');
            $table->string('center');
            $table->string('date');
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
        Schema::dropIfExists('booking1s');
    }
}
