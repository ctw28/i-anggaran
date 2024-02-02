<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_beritas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_sesi_id');
            $table->foreign('periksa_sesi_id')->references('id')->on('periksa_sesis');
            $table->date('tanggal');
            $table->string('nomor');

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
        Schema::dropIfExists('periksa_beritas');
    }
}
