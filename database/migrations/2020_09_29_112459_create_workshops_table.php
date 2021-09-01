<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
Schema::create('workshops', function (Blueprint $table) {
$table->bigIncrements('id');
$table->string('c_name');
$table->string('p_name');
$table->string('p_price');
$table->string('pull');
$table->string('quantity');
$table->string('date');
$table->timestamps();
});}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workshops');
    }
}
