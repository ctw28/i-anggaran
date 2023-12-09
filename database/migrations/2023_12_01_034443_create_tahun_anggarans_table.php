<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAnggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_anggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('satker_id');
            $table->foreign('satker_id')->references('id')->on('satkers');

            $table->year('tahun');
            $table->string('sebutan');
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
        Schema::dropIfExists('tahun_anggarans');
    }
}
