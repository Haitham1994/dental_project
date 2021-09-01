<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwmanhoistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('owmanhoistories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('married');
            $table->string('marriedCon');
            $table->string('load');
            $table->string('loadCon');
            $table->string('pregnancymonth');
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
        Schema::dropIfExists('owmanhoistories');
    }
}
