<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaBarjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_barjas', function (Blueprint $table) {
            $table->id();
            $table->string('satker');
            $table->string('barjas_nama');
            $table->string('ppk');
            $table->string('pejabat_pengadaan');
            $table->string('rekanan');
            $table->string('metode');
            $table->string('tanggal_kontrak');
            $table->string('nilai');
            $table->string('kode_akun');
            $table->string('jumlah_dokumen');
            $table->string('tangal_periksa');
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
        Schema::dropIfExists('periksa_barjas');
    }
}
