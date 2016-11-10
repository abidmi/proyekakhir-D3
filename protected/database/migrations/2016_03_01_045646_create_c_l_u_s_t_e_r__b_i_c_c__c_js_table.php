<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCLUSTERBICCCJsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CLUSTER_BICC_CJ', function (Blueprint $table) {
            $table->increments('id');
            $table->string('POC_NAME');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('CLUSTER_BICC_CJ');
    }
}
