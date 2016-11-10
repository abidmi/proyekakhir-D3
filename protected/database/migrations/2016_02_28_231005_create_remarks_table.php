<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optimcj_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bscrnc');
            $table->string('cell');
            $table->string('area');
            $table->string('kpi');
            $table->string('kategori');
            $table->string('date_ex');
            $table->string('date_close');
            $table->string('remark');
            $table->string('status');
            $table->string('created_by');
            $table->string('update_by');
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
        Schema::drop('optimcj_remarks');
    }
}
