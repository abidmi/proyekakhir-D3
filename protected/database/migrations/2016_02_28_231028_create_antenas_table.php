<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAntenasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optimcj_antenas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bscrnc');
            $table->string('siteid');
            $table->string('cell');
            $table->string('mech');
            $table->string('elec');
            $table->string('tot');
            $table->string('dir');
            $table->string('height');
            $table->string('bw');
            $table->string('type');
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
        Schema::drop('optimcj_antenas');
    }
}
