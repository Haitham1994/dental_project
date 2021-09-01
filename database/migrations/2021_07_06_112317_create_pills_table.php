<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('b_id')->unsigned();
            $table->foreign('b_id')->references('id')->on('booking1s')->onDelete('cascade');
            $table->string('cash');
            $table->string('pull');
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
        Schema::dropIfExists('pills');
    }
}
