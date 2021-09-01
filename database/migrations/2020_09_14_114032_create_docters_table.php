<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('doc_name');
            $table->string('doc_gender');
            $table->string('doc_nation');
            $table->string('doc_address');
            $table->string('doc_age');
            $table->string('doc_spec');
            $table->string('doc_degree');
            $table->string('doc_phone');
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
        Schema::dropIfExists('docters');
    }
}
