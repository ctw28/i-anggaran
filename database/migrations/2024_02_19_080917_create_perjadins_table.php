<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjadinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjadins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_id');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatans');
            $table->string('nama_perjadin');
            $table->string('kota_tujuan');
            $table->date('tanggal_dokumen');
            $table->string('no_surat_tugas');
            $table->date('tanggal_surat_tugas');

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
        Schema::dropIfExists('perjadins');
    }
}
