<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePencairanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pencairan_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pencairan_id');
            $table->foreign('pencairan_id')->references('id')->on('pencairans')->onDelete('cascade');
            $table->string('nomor_sk');
            $table->date('tanggal_sk');
            $table->date('tanggal_dokumen');
            $table->date('tanggal_lunas')->nullable();
            $table->string('penerima_nama');
            $table->string('penerima_jabatan');
            $table->string('penerima_nomor')->nullable();
            $table->string('kuitansi_nomor')->nullable();
            $table->string('sptjb_nomor');
            $table->string('sptjk_nama');
            $table->string('sptjk_nip');
            $table->string('sptjk_jabatan');
            $table->unsignedBigInteger('ppk')->nullable();
            $table->foreign('ppk')->references('id')->on('organisasi_jabatan_sesis')->onDelete('set null');
            $table->unsignedBigInteger('bendahara')->nullable();
            $table->foreign('bendahara')->references('id')->on('organisasi_jabatan_sesis')->onDelete('set null');
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
        Schema::dropIfExists('dokumen_pencairan_details');
    }
}
