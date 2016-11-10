<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCGI2GCJsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CGI2G_CJ', function (Blueprint $table) {
            $table->increments('id');
            $table->string('BSC');
            $table->string('SITE_ID');
            $table->string('CELL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CGI2G_CJ');
    }
}
