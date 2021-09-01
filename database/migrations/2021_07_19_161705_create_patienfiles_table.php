<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatienfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patienfiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('b_id')->unsigned();
            $table->foreign('b_id')->references('id')->on('booking1s')->onDelete('cascade');
            $table->string('imag');
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
        Schema::dropIfExists('patienfiles');
    }
}
