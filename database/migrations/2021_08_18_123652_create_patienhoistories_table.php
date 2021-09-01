<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatienhoistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('patienhoistories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('b_id')->unsigned();
            $table->foreign('b_id')->references('id')->on('booking1s')->onDelete('cascade');
            $table->bigInteger('not_id')->unsigned();
            $table->foreign('not_id')->references('id')->on('notes')->onDelete('cascade');
            $table->bigInteger('p_id')->unsigned();
            $table->foreign('p_id')->references('id')->on('peeps')->onDelete('cascade');
            $table->bigInteger('ow_id')->unsigned();
            $table->foreign('ow_id')->references('id')->on('owmanhoistories')->onDelete('cascade');
            $table->bigInteger('dia_id')->unsigned();
            $table->foreign('dia_id')->references('id')->on('diabeteshoistories')->onDelete('cascade');
            $table->string('overblood');
            $table->string('bloodCon');
            $table->string('diseaseheart');
            $table->string('heartCon');
            $table->string('fallen');
            $table->string('fallenCon');
            $table->string('heat');
            $table->string('heatCon');
            $table->string('kidney');
            $table->string('kidneyCon');
            $table->string('fire');
            $table->string('fireCon');
            $table->string('anemia');
            $table->string('anemiaCon');
            $table->string('bleeding');
            $table->string('bleedingCon');
            $table->string('adenitis');
            $table->string('adenitisCon');
            $table->string('asthma');
            $table->string('asthmaCon');
            $table->string('allergy');
            $table->string('allergyCon');
            $table->string('drug');
            $table->string('drugCon');
            $table->string('other');
            $table->string('otherCon');
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
        Schema::dropIfExists('patienhoistories');
    }
}
