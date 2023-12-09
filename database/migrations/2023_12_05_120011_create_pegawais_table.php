<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('idpeg', 100);
            $table->string('pegawai_nomor_induk', 100);
            $table->unsignedBigInteger('data_diri_id');
            $table->foreign('data_diri_id')->references('id')->on('data_diris')->onDelete('cascade');
            $table->unsignedBigInteger('pegawai_kategori_id');
            $table->foreign('pegawai_kategori_id')->references('id')->on('pegawai_kategoris')->onDelete('cascade');
            $table->unsignedBigInteger('pegawai_jenis_id');
            $table->foreign('pegawai_jenis_id')->references('id')->on('pegawai_jenis')->onDelete('cascade');
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
        Schema::dropIfExists('pegawais');
    }
}
