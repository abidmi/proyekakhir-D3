<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCGI3GCJsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CGI3G_CJ', function (Blueprint $table) {
            $table->increments('id');
            $table->string('RNC');
            $table->string('SITE_ID');
            $table->string('UTRANCELL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CGI3G_CJ');
    }
}
