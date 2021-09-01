<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantresults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pl_name');
            $table->string('pl_doname');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('pl_relation');
            $table->string('pl_reduction');
            $table->string('pl_center');
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
        Schema::dropIfExists('plantresults');
    }
}
