<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optimcj_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bscrnc');
            $table->string('siteid');
            $table->string('sitename');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('celltype');
            $table->string('mbc');
            $table->string('collsite');
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
        Schema::drop('optimcj_sites');
    }
}
