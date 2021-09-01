<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('labresults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('b_id')->unsigned();
            $table->foreign('b_id')->references('id')->on('booking1s')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('d_id')->unsigned();
            $table->foreign('d_id')->references('id')->on('dentals')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('p_id')->unsigned();
            $table->foreign('p_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->string('price');
            $table->string('redate');
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
        Schema::dropIfExists('labresults');
    }
}
